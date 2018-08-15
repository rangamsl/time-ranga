<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class kjtbHomeController extends Controller
{
    /**
     * @Route("/kjtb", name="kjtbhome")
     */
    public function kjtbhome()
    {
        return $this->render('kjtb/home.html.twig', [
            'controller_name' => 'kjtbHomeController',
        ]);
    }
}
