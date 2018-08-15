<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class kjtbGetUpdatedController extends Controller
{
    /**
     * @Route("/kjtb/admin/get-updated", name="get_updated")
     */
    public function index()
    {
        return $this->render('kjtb/admin/get_updated.html.twig', [
            'controller_name' => 'kjtbGetUpdatedController',
        ]);
    }
}
