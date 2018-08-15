<?php
namespace App\Controller;

use App\Repository\TimeRepository;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/time-log")
 */
class TimeLogController
{
    /**
     * @var \Twig_Environment
     */
    private $twig;
    /**
     * @var TimeRepository
     */
    private $timeRepository;

    public function __construct(\Twig_Environment $twig, TimeRepository $timeRepository)
    {

        $this->twig = $twig;
        $this->timeRepository = $timeRepository;
    }


    /**
     * @Route("/", name="time_log_index")
     */
    public function index()
    {
        $html = $this->twig->render('time-log/index.html.twig', [
            'posts' => $this->timeRepository->findAll()
       ]);
        return new Response($html);

    }
}