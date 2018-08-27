<?php
namespace App\Controller;
use App\Entity\Time;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use App\Repository\TimeRepository;

use  Symfony\Component\Form\Extension\Core\Type\TextType;
use  Symfony\Component\Form\Extension\Core\Type\TextareaType;
use  Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Form\Extension\Core\Type\DateType;

/**
 * @Route("/time-log")
 */
class TimeController extends Controller
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
//            'posts' => $this->timeRepository->findAll()
            'posts' => $this->timeRepository->findRecent(10)
//            'posts' => $this->timeRepository->findBy(array(), array(), array(), 5, 5)
        ]);
//       $html = $this->timeRepository->findAll();
        return new Response($html);

    }






    /**
     * @Route("/new", name="new_time_log")
     * Method({"GET", "POST"})
     */



    public function new(Request $request){
        $time = new Time();

        $form = $this->createFormBuilder($time)


            ->add('day', DateType::class, array(
                'widget' => 'choice',
                 'label_format' => 'Date',
                'attr' => array('class' => 'm-b')
               ))

            ->add('projectid', TextType::class, array('attr' =>
                array('class' => 'form-control m-b'),
                'label_format' => 'Project id',
            ))

            ->add('projectcode', TextType::class, array('attr' =>
                array('class' => 'form-control m-b'),
                'label_format' => 'Project Name',
            ))

            ->add('description', TextareaType::class, array('attr' =>
                array('class' => 'form-control m-b'),
                 'label_format' => 'Description',
            ))
            ->add('timenotes', TextType::class, array('attr' =>
                array('class' => 'form-control m-b'),
                'label_format' => 'Time Notes',
            ))


            ->add('save', SubmitType::class, array(
                'label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $time = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($time);
            $entityManager->flush();

            return $this->redirectToRoute('time_log_index');
        }

        return $this->render('time-log/new.html.twig', array('form' => $form->createView()
        ));

    }





    /**
     * @Route("/edit/{id}", name="edit_time_log")
     * Method({"GET", "POST"})
     */



    public function edit(Request $request, $id){
        $time = new Time();

        $time = $this->getDoctrine()->getRepository
        (Time::class)->find($id);


        $form = $this->createFormBuilder($time)

            ->add('day', DateType::class, array(
                'widget' => 'choice',
                'label_format' => 'Date',
                'attr' => array('class' => 'm-b')
            ))

            ->add('projectcode', TextType::class, array('attr' =>
                array('class' => 'form-control m-b'),
                'label_format' => 'Project Name',
            ))

            ->add('description', TextareaType::class, array('attr' =>
                array('class' => 'form-control m-b'),
                'label_format' => 'Description',
            ))
            ->add('timenotes', TextType::class, array('attr' =>
                array('class' => 'form-control m-b'),
                'label_format' => 'Time Notes',
            ))


            ->add('save', SubmitType::class, array(
                'label' => 'Update',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('time_log_index');
        }

        return $this->render('time-log/edit.html.twig', array('form' => $form->createView()
        ));

    }






  /**
   * @Route("/time-log/delete/{id}")
   * @Method({"DELETE"})
  */
public function delete(Request $request, $id) {

    $times = $this->getDoctrine()->getRepository
    (Times::class)->find($id);

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($times);
    $entityManager->flush();

    $response = new Response();
    $response->send();
    return $this->redirect($this->generateUrl('time-log'));
}









}
