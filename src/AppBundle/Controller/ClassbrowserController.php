<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

}
