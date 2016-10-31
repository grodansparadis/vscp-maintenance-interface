<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class VSCPUserController extends Controller
{
    /**
     * @Route("/vscpuser", name="vscpmaint_user")
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
   * @Route("/vscpuseredit", name="vscpmaint_useredit")
   */
    public function edituserAction( $username )
    {

      $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($username);

        $form = $this->createForm(new UserType, $user);

    $request = $this->get('request');

    if ($request->getMethod() == 'POST') {
      $form->bind($request);

      if ($form->isValid()) {
        $password = $form["password"]->getData();
        $user->setPlainPassword($password);
        $userManager -> updateUser($user);

        return $this->redirect($this->generateUrl('admin_user'));
      }
    }

        return $this->render('LljmAdminBundle:User:useredit.html.twig', array(
          'user' => $user,
          'form' => $form->createView()
          ));
    }

}
