<?php

namespace AppBundle\Controller;

use AppBundle\Entity\VSCPByte;
use AppBundle\Entity\VSCPType;
use AppBundle\Form\VSCPByteType;
use AppBundle\Form\VSCPTypeListType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VSCPByteController extends Controller
{
    /**
     * @Route("/vscpbyte", name="vscpmaint_vscpbyte")
     */
    public function vscpbyteAction(Request $request)
    {
    $vscptypelist = new VSCPType;

    $form = $this->createForm(VSCPTypeListType::class, $vscptypelist);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

    $vscptypeid = $vscptypelist->getVscptypeName()->getId();

    $vscpbyte = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('AppBundle:VSCPByte')
                     ->getVSCPByteByType($vscptypeid);

        return $this->render('vscpbyte/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'vscpbyte' => $vscpbyte,
            'form' => $form->createView(),
            'vscptypeid' => $vscptypeid,
		]);
    }
    else{
        return $this->render('vscpbyte/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
    ]);
    }
    }

    /**
     * @Route("/vscpbyte_add", name="vscpmaint_vscpbyteadd")
     * @Security("has_role('ROLE_ADMIN')")
     */

    public function byteaddAction(Request $request)
    {
        $vscpbyte = new VSCPByte;

        $form = $this->createForm(VSCPByteType::class, $vscpbyte);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($vscpbyte);
        $em->flush();

        return $this->redirect($this->generateUrl('vscpmaint_vscpbyte'));
    }
        return $this->render('vscpbyte/vscpbyteadd.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/vscpbyte_delete/{id}", name="vscpmaint_vscpbytedelete")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function bytedeleteAction(Request $request, VSCPByte $vscpbyte)
    {

    $form = $this->createFormBuilder()->getForm();
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($vscpbyte);
        $em->flush();

        $this->get('session')->getFlashBag()->add('info', 'Class deleted');

        return $this->redirect($this->generateUrl('vscpmaint_vscpbyte'));

      }

    return $this->render('vscpbyte/vscpbytedel.html.twig', [
      'vscpbyte' => $vscpbyte,
      'form'    => $form->createView()
    ]);
    }

    /**
     * @Route("/vscpbyte_edit/{id}", name="vscpmaint_vscpbyteedit")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function byteeditAction(Request $request, VSCPByte $vscpbyte)
    {
    $form = $this->createForm(VSCPByteType::class, $vscpbyte);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($vscpbyte);
        $em->flush();

        $this->get('session')->getFlashBag()->add('info', 'Class updated');

    $vscptypelist = new VSCPType;

    $form = $this->createForm(VSCPTypeListType::class, $vscptypelist);

    $form->handleRequest($request);

    $vscptypeid = $vscpbyte->getVscpbytetype()->getId();

    $vscpbyte = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('AppBundle:VSCPByte')
                     ->getVSCPByteByType($vscptypeid);

        return $this->render('vscpbyte/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'vscpbyte' => $vscpbyte,
            'form' => $form->createView(),
            'vscptypeid' => $vscptypeid,
        ]);
      }

    return $this->render('vscpbyte/vscpbyteedit.html.twig', [
      'vscpbyte' => $vscpbyte,
      'form'    => $form->createView()
    ]);
    }

}
