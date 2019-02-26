<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/admin/new/collaborateur", name="new_collaborateur")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new Users();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $form->get('Password')->getData() == $form->get('Confirmation')->getData() ) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('Password')->getData()
                )
            );
            $user->setRoles(
                $form->get('roles')->getData()
            );
            $user->setNom(
                $form->get('nom')->getData()
            );
            $user->setPrenom(
                $form->get('prenom')->getData()
            );
            $user->setTel(
                $form->get('tel')->getData()
            );
            $user->setService(
                $form->get('service')->getData()
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('collaborateur');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
