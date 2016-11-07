<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\VSCPClass;

class ClassbrowserController extends Controller
{
    /**
     * @Route("/classbrowser", name="vscpmaint_classbrowser")
     */
    public function classbrowserAction(Request $request)
    {

    $vscpclass = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('AppBundle:VSCPClass')
                     ->getVSCPClass();

        return $this->render('vscpclassbrowser/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'vscpclass' => $vscpclass,
        ]);
    }

    /**
     * @Route("/indexbrowser/{id}", name="vscpmaint_indexbrowser")
     */
    public function indexbrowserAction(Request $request, VSCPClass $selectedclass)
    {

    $vscpclass = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('AppBundle:VSCPClass')
                     ->getVSCPClass();

    $vscpclassid = $selectedclass->getId();

    $vscptype = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('AppBundle:VSCPType')
                     ->GetVSCPTypeByClass($vscpclassid);

        return $this->render('vscpclassbrowser/typelist.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'vscpclass' => $vscpclass,
            'selectedclass' => $selectedclass,
            'vscptype' => $vscptype,
        ]);
    }

}
