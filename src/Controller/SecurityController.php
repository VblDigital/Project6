<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Form\NewPassType;
use App\Form\EmailType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends CommunityController
{
    /**
     * @Route("/registration", name="security_registration")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/registration.html.twig', [
            'formRegistration' => $form->createView()
        ]);
    }

    /**
     * @Route("/newpassword", name="password_recovery")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function request(Request $request, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator)
    {
        $form = $this->createForm(EmailType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $email = $request->request->get('email');

            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);

            /* @var $user User */
            if ($user === null) {
                $this->addFlash('danger', 'Cette adresse email ne correspond à aucun compte utilisateur');
                return $this->redirectToRoute('password_recovery');
            }
            $token = $tokenGenerator->generateToken();

            try{
                $user
                    ->setToken($token)
                    ->setPasswordRequestedAt(new \DateTime());
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('login');
            }

            $url = $this->generateUrl('reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            $message = (new \Swift_Message('Demande de réinitialisation du mot de passe'))
                ->setFrom('no-reply@snowtricks.com')
                ->setTo($user->getEmail())
                ->setBody(
                    "Cher Utilisateur,<br/>Une demande de réinitialisation de mot passe a été faite depuis votre compte Snowtricks.<br/>
                    Afin de paramétrer un nouveau mot de passe, merci de cliquer ici :" . $url . ".<br/>A bientôt sur le site de Snowtricks.",
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash('notice', 'Un email vient d\'être envoyé.' );

            return $this->redirectToRoute('login');
        }

        return $this->render('security/passwordRecovery.html.twig', [
            'formEmail' => $form->createView()
        ]);
    }

    private function isRequestInTime(\Datetime $passwordRequestedAt = null)
    {
        if ($passwordRequestedAt === null)
        {
            return false;
        }

        $now = new \DateTime();
        $interval = $now->getTimestamp() - $passwordRequestedAt->getTimestamp();

        $delay = 86400;
        $response = $interval > $delay ? false : $reponse = true;
        return $response;
    }

    /**
     * @Route("/reset_password/{token}", name="reset_password")
     */
    public function resetPassword(User $user, string $token, Request $request, UserPasswordEncoderInterface $encoder)
    {
        if (!$this->isRequestInTime($user->getPasswordRequestedAt())) {
            $this->addFlash('danger', 'Ce lien n\'est plus valide. Il n\'est valable que 24h. Merci de refaire votre demande.');
            return $this->redirectToRoute('password_recovery');
        }

        $form = $this->createForm(NewPassType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(User::class)->findOneByToken($token);

            /* @var $user User */
            if ($user === null) {
                $this->addFlash('danger', 'Ce lien n\'est plus valide. Il n\'est utilisable qu\'une seule fois. Merci de refaire votre demande.');
                return $this->redirectToRoute('password_recovery');
            }

            $user
                ->setToken(null)
                ->setPasswordRequestedAt(null);

            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $entityManager->flush();

            $this->addFlash('notice', 'Votre mot de passe a été mis à jour');

            return $this->redirectToRoute('login');
        }else {

            return $this->render('security/passwordReset.html.twig', [
                'token' => $token,
                'formNewPass' => $form->createView()]);
        }
    }

    /**
     * @Route("/login", name="security_login")
     */
    public function login ()
    {
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/logout", name="security_logout")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function logout() {}

    /**
     * @Route("/user/{id}", name="view_user")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function viewUser($id)
    {
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->find($id);

        return $this->render('community/viewUser.html.twig', [
            'user' => $user
        ]);
    }
}
