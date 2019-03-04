<?php

namespace App\Controller;

use App\Entity\Anonymes;
use App\Entity\Oeuvres;
use App\Entity\Expositions;
use App\Form\OeuvresType;
use App\Form\OeuvresEditType;
use App\Repository\OeuvresRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Session\Session;

use Endroid\QrCode\QrCode;

/**
 * @Route("/oeuvres")
 */
class OeuvresController extends AbstractController
{

    const LIEN =  "http://10.255.249.49:8000/oeuvres/";
    const EXTENSION = '.png';

    /**
     * @Route("/", name="oeuvres_index", methods={"GET"})
     */
    public function index(OeuvresRepository $oeuvresRepository): Response
    {
        return $this->render('oeuvres/index.html.twig', [
            'oeuvres' => $oeuvresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="oeuvres_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $oeuvre = new Oeuvres();
        $form = $this->createForm(OeuvresType::class, $oeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $oeuvre->setPath($fileUploader->upload($form['path']->getData()));

            $entityManager->persist($oeuvre);

            $entityManager->flush();


            $qrCode = new QrCode(self::LIEN . $oeuvre->getId());
            // Save it to a file
            $qrCode->writeFile($this->getParameter('qr_codes_directory') . $oeuvre->getTitre() . $oeuvre->getId() . self::EXTENSION);

            return $this->redirectToRoute('oeuvres_index');
        }

        return $this->render('oeuvres/new.html.twig', [
            'oeuvre' => $oeuvre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="oeuvres_show", methods={"GET"})
     */
    public function show(Oeuvres $oeuvre): Response
    {   

        $entityManager = $this->getDoctrine()->getManager();
        $session = new Session();
        $anonyme = new Anonymes();


        $emp = $oeuvre->getEmplacement();
        $name = $session->get('name');
        $a = $entityManager->getRepository(Anonymes::class)->findOneBy(array('name' => "$name"));
        $expo = $oeuvre->getExposition()->toArray();
        $expo[0]->setNbVues($expo[0]->getNbVues() + 1);

        if(!$a) {
            $session->start();
            $session->set('count', 0);
            $session->set('name', uniqid());
            $anonyme->setName($session->get('name'));
            $anonyme->setOrdre($emp);
            $anonyme->setExposition($expo[0]);
            $entityManager->persist($anonyme);
            $entityManager->flush();   
        } else {
            $a->setOrdre($a->getOrdre() . $emp);
            $session->set('count', $session->get('count') + 1);
            $entityManager->flush();
        }    
        if($a && strlen($a->getOrdre()) == 5 && ucfirst($a->getOrdre()) == ucfirst($expo[0]->getOrdre())) {
            session_destroy();
            $this->addFlash('success', 'Félicitations Vous avez trouvé le Golden Path');
        }

        return $this->render('oeuvres/show.html.twig', [
            'oeuvre' => $oeuvre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="oeuvres_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Oeuvres $oeuvre, FileUploader $fileUploader): Response
    {


        $form = $this->createForm(OeuvresEditType::class, $oeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush(); 

            return $this->redirectToRoute('oeuvres_index', [
                'id' => $oeuvre->getId(),
            ]);
        }

        return $this->render('oeuvres/edit.html.twig', [
            'oeuvre' => $oeuvre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="oeuvres_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Oeuvres $oeuvre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$oeuvre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($oeuvre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('oeuvres_index');
    }
}
