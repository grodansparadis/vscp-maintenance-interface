<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;

class VSCPUserController extends Controller
{
    /**
     * @Route("/vscpuser", name="vscpmaint_user")
   * @Security("has_role('ROLE_ADMIN')")
     */
    public function userAction(Request $request)
    {

	    $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render('users/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'users' => $users,
        ]);
    }

  /**
   * @Route("/vscpuserdelete/{username}", name="vscpmaint_userdelete")
   * @Security("has_role('ROLE_ADMIN')")
   */
    public function deluserAction( Request $request, $username )
  {

    $userManager = $this->get('fos_user.user_manager');
    $user = $userManager->findUserByUsername($username);

    $form = $this->createFormBuilder()->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $userManager -> deleteUser($user);

	    $this->get('session')->getFlashBag()->add('info', 'User deleted');

        return $this->redirect($this->generateUrl('vscpmaint_user'));
      }

    return $this->render('users/userdel.html.twig', [
      'user' => $user,
      'form'    => $form->createView()
    ]);

  } 

  /**
   * @Route("/vscpuseredit/{username}", name="vscpmaint_useredit")
   * @Security("has_role('ROLE_ADMIN')")
   */
    public function edituserAction( Request $request, $username )
    {

      $userManager = $this->get('fos_user.user_manager');
      $user = $userManager->findUserByUsername($username);

      $form = $this->createForm(UserType::class, $user);
      $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
//        $password = $form["password"]->getData();
//        $user->setPlainPassword($password);
        $userManager -> updateUser($user);

        return $this->redirect($this->generateUrl('vscpmaint_user'));
      }

    return $this->render('users/useredit.html.twig', [
      'user' => $user,
      'form'    => $form->createView()
    ]);

    }

}
