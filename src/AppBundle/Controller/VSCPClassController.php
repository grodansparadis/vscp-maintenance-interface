<?php

namespace AppBundle\Controller;

use AppBundle\Entity\VSCPClass;
use AppBundle\Form\VSCPClassType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VSCPClassController extends Controller
{
    /**
     * @Route("/vscpclass", name="vscpmaint_vscpclass")
     */
    public function vscpclassAction(Request $request)
    {
    $vscpclass = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('AppBundle:VSCPClass')
                     ->getVSCPClass();

        return $this->render('vscpclass/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
              'vscpclass' => $vscpclass,
		]);
    }

    /**
     * @Route("/vscpclass_add", name="vscpmaint_vscpclassadd")
     */
    public function classaddAction(Request $request)
    {
        $vscpclass = new VSCPClass;

        $form = $this->createForm(VSCPClassType::class, $vscpclass);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($vscpclass);
        $em->flush();

        return $this->redirect($this->generateUrl('vscpmaint_vscpclass'));
    }
        return $this->render('vscpclass/vscpclassadd.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/vscpclass_delete/{id}", name="vscpmaint_vscpclassdelete")
     */
    public function classdeleteAction(Request $request, VSCPClass $vscpclass)
    {

    $form = $this->createFormBuilder()->getForm();
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($vscpclass);
        $em->flush();

        $this->get('session')->getFlashBag()->add('info', 'Class deleted');

        return $this->redirect($this->generateUrl('vscpmaint_vscpclass'));

      }

    return $this->render('vscpclass/vscpclassdel.html.twig', [
      'vscpclass' => $vscpclass,
      'form'    => $form->createView()
    ]);
    }

    /**
     * @Route("/vscpclass_edit/{id}", name="vscpmaint_vscpclassedit")
     */
    public function classeditAction(Request $request, VSCPClass $vscpclass)
    {
    $form = $this->createForm(VSCPClassType::class, $vscpclass);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($vscpclass);
        $em->flush();

        $this->get('session')->getFlashBag()->add('info', 'Class updated');

        return $this->redirect($this->generateUrl('vscpmaint_vscpclass'));

      }

    return $this->render('vscpclass/vscpclassedit.html.twig', [
      'vscpclass' => $vscpclass,
      'form'    => $form->createView()
    ]);
    }

}
