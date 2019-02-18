<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\UsersType;
use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
* @Route("/admin")
*/
class CollaborateurController extends AbstractController
{
    /**
     * @Route("/collaborateur", name="collaborateur", methods={"GET"})
     */
    public function index(UsersRepository $usersRepo)
    {
        return $this->render('collaborateur/index.html.twig', [
            'collaborateurs' => $usersRepo->findAll()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="collaborateur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Users $user): Response
    {
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute('collaborateur');
        }

        return $this->render('collaborateur/edit.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="collaborateur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Users $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('collaborateur');
    }
}
