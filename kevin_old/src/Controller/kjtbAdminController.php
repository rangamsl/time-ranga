<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class kjtbAdminController extends AbstractController
{
	/**
	 * @Route("/kjtb/admin")
	 */
	public function kjtbadmin()
	{
		$number = random_int(0, 100);

		/* return new Response(
			'Admin TEST, random number: '.$number.''
		); */
		return $this->render('kjtb/admin/admin.html.twig', array(
            'number' => $number,
            'controller_name' => 'kjtbAdminController',
        ));
	}
}
