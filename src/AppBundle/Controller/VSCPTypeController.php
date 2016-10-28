<?php

namespace AppBundle\Controller;

use AppBundle\Entity\VSCPType;
use AppBundle\Entity\VSCPClass;
use AppBundle\Form\VSCPTypeType;
use AppBundle\Form\VSCPClassListType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VSCPTypeController extends Controller
{
    /**
     * @Route("/vscptype", name="vscpmaint_vscptype")
     */
    public function vscptypeAction(Request $request)
    {

    $vscpclasslist = new VSCPClass;

    $form = $this->createForm(VSCPClassListType::class, $vscpclasslist);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

    $vscpclassid = $vscpclasslist->getVscpclassName()->getId();

    $vscptype = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('AppBundle:VSCPType')
                     ->getVSCPTypeByClass($vscpclassid);

        return $this->render('vscptype/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'vscptype' => $vscptype,
            'form' => $form->createView(),
            'vscpclassid' => $vscpclassid,
		]);
    }
    else{
        return $this->render('vscptype/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
    ]);

    }
    }

    /**
     * @Route("/vscptype_add", name="vscpmaint_vscptypeadd")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function typeaddAction(Request $request)
    {
        $vscptype = new VSCPType;

        $form = $this->createForm(VSCPTypeType::class, $vscptype);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($vscptype);
        $em->flush();

        return $this->redirect($this->generateUrl('vscpmaint_vscptype'));
    }
        return $this->render('vscptype/vscptypeadd.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/vscptype_delete/{id}", name="vscpmaint_vscptypedelete")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function typedeleteAction(Request $request, VSCPType $vscptype)
    {

    $form = $this->createFormBuilder()->getForm();
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($vscptype);
        $em->flush();

        $this->get('session')->getFlashBag()->add('info', 'Class deleted');

        return $this->redirect($this->generateUrl('vscpmaint_vscptype'));

      }

    return $this->render('vscptype/vscptypedel.html.twig', [
      'vscptype' => $vscptype,
      'form'    => $form->createView()
    ]);
    }

    /**
     * @Route("/vscptype_edit/{id}", name="vscpmaint_vscptypeedit")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function typeeditAction(Request $request, VSCPType $vscptype)
    {
    $form = $this->createForm(VSCPTypeType::class, $vscptype);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($vscptype);
        $em->flush();

        $this->get('session')->getFlashBag()->add('info', 'Class updated');

        return $this->redirect($this->generateUrl('vscpmaint_vscptype'));

      }

    return $this->render('vscptype/vscptypeedit.html.twig', [
      'vscptype' => $vscptype,
      'form'    => $form->createView()
    ]);
    }

}
