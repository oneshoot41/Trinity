<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            
        ]);
    }
    
    /**
     * @Route("/plan", name="plan")
     */
    public function plan()
    {
        return $this->render('plan/plan.html.twig', [
            
        ]);
    }
}
