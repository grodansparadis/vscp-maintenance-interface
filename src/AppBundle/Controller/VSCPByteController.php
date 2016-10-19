<?php

namespace AppBundle\Controller;

use AppBundle\Entity\VSCPByte;
use AppBundle\Form\VSCPByteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VSCPByteController extends Controller
{
    /**
     * @Route("/vscpbyte", name="vscpmaint_vscpbyte")
     */
    public function vscpbyteAction(Request $request)
    {
    $vscpbyte = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('AppBundle:VSCPByte')
                     ->getVSCPByte();

        return $this->render('vscpbyte/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
              'vscpbyte' => $vscpbyte,
		]);
    }

    /**
     * @Route("/vscpbyte_add", name="vscpmaint_vscpbyteadd")
     */
    public function typeaddAction(Request $request)
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
     */
    public function typedeleteAction(Request $request, VSCPByte $vscpbyte)
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
     */
    public function typeeditAction(Request $request, VSCPByte $vscpbyte)
    {
    $form = $this->createForm(VSCPByteType::class, $vscpbyte);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($vscpbyte);
        $em->flush();

        $this->get('session')->getFlashBag()->add('info', 'Class updated');

        return $this->redirect($this->generateUrl('vscpmaint_vscpbyte'));

      }

    return $this->render('vscpbyte/vscpbyteedit.html.twig', [
      'vscpbyte' => $vscpbyte,
      'form'    => $form->createView()
    ]);
    }

}
