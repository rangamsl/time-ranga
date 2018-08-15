<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Psr\Log\LoggerInterface;


class CronController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

	/**
	 * @Route("/cron")
	 */
	public function cron()
	{

		// --- Logger Tests ---

		$this->logger->info('Information logged');
		$this->logger->error('An error occurred');

		$this->logger->critical('Critical message logged!', array(
			// include extra "context" info in your logs
			'additional_info' => 'more_details',
		));


		// --- Random Number ---

		$cron = random_int(0, 100);

		return new Response(
			'Cron TEST, random number: '.$cron.''
		);
	}
}
