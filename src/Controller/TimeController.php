<?php
namespace App\Controller;

use App\Entity\Time;
use App\Form\TimeLogType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use App\Repository\TimeRepository;
use Symfony\Component\Routing\RouterInterface;

/**
 * @Route("/time-log")
 */
class TimeController
{
    /**
     * @var \Twig_Environment
     */
    private $environment;
    /**
    /**
     * @var \Twig_Environment
     */
    private $twig;
    /**
     * @var TimeRepository
     */
    private $timeRepository;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * TimeController constructor.
     * @param \Twig_Environment $twig
     * @param TimeRepository $timeRepository
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(\Twig_Environment $twig, TimeRepository $timeRepository,
                                FormFactoryInterface $formFactory, EntityManagerInterface $entityManager,
                                RouterInterface $router
)
    {
        $this->twig = $twig;
        $this->timeRepository = $timeRepository;
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->router = $router;
    }


    /**
     * @Route("/", name="time_log_index")
     */
    public function index()
    {
        $html = $this->twig->render('time-log/index.html.twig', [
//            'posts' => $this->timeRepository->findAll()
            'posts' => $this->timeRepository->findRecent(10)
//            'posts' => $this->timeRepository->findBy(array(), array(), array(), 5, 5)
        ]);
//       $html = $this->timeRepository->findAll();
        return new Response($html);

    }


    /**
     * @Route("/add", name="time_log_add")
     */

    public function add(Request $request)
    {
            $timeLog = new Time();
            //$timeLog->setTime(new \DateTime());

            $form = $this->formFactory->create( TimeLogType::class, $timeLog);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                    $this->entityManager->presist($timeLog);
                    $this->entityManager->flush();

                    return new RedirectResponse(
                        $this->router->generate('time_log_index')
                    );
            }


        return new Response(
            $this->twig->render(
                'time-log/add.html.twig',
            [
                'form' => $form->createView(),
            ]
            )


        );
    }

}
