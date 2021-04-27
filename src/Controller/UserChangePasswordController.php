<?php


namespace App\Controller;

use App\Form\ChangePasswordFormType;
use App\Form\UserSettingsFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserChangePasswordController extends AbstractController
{
    /**
     * @Route("/user/changepassword", name="app_user_change_password")
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('newPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_logout');

        }



        return $this->render('user/changePassword.html.twig', ['ChangePasswordForm' => $form->createView()]);
    }

    /**
     * @Route("/user/settings", name="app_user_settings")
     */
    public function settings(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();
        $form = $this->createForm(UserSettingsFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setName($form->get('name')->getData());
            $user->setSurname($form->get('surname')->getData());
            $user->setPhone($form->get('phone')->getData());
            $user->setRecieveNotifications(
                    $form->get('recieveNotifications')->getData()
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_user_settings');
        }





        return $this->render('user/settings.html.twig', ['SettingsForm' => $form->createView()]);
    }
}