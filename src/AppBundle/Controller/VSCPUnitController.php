<?php

namespace AppBundle\Controller;

use AppBundle\Entity\VSCPUnit;
use AppBundle\Form\VSCPUnitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VSCPUnitController extends Controller
{
    /**
     * @Route("/vscpunit", name="vscpmaint_vscpunit")
     */
    public function vscpunitAction(Request $request)
    {
    $vscpunit = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('AppBundle:VSCPUnit')
                     ->getVSCPUnit();

        return $this->render('vscpunit/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
              'vscpunit' => $vscpunit,
		]);
    }

    /**
     * @Route("/vscpunit_add", name="vscpmaint_vscpunitadd")
     */
    public function typeaddAction(Request $request)
    {
        $vscpunit = new VSCPUnit;

        $form = $this->createForm(VSCPUnitType::class, $vscpunit);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($vscpunit);
        $em->flush();

        return $this->redirect($this->generateUrl('vscpmaint_vscpunit'));
    }
        return $this->render('vscpunit/vscpunitadd.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/vscpunit_delete/{id}", name="vscpmaint_vscpunitdelete")
     */
    public function typedeleteAction(Request $request, VSCPUnit $vscpunit)
    {

    $form = $this->createFormBuilder()->getForm();
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($vscpunit);
        $em->flush();

        $this->get('session')->getFlashBag()->add('info', 'Class deleted');

        return $this->redirect($this->generateUrl('vscpmaint_vscpunit'));

      }

    return $this->render('vscpunit/vscpunitdel.html.twig', [
      'vscpunit' => $vscpunit,
      'form'    => $form->createView()
    ]);
    }

    /**
     * @Route("/vscpunit_edit/{id}", name="vscpmaint_vscpunitedit")
     */
    public function typeeditAction(Request $request, VSCPUnit $vscpunit)
    {
    $form = $this->createForm(VSCPUnitType::class, $vscpunit);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($vscpunit);
        $em->flush();

        $this->get('session')->getFlashBag()->add('info', 'Class updated');

        return $this->redirect($this->generateUrl('vscpmaint_vscpunit'));

      }

    return $this->render('vscpunit/vscpunitedit.html.twig', [
      'vscpunit' => $vscpunit,
      'form'    => $form->createView()
    ]);
    }

}
