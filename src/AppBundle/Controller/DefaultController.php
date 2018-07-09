<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TaskComment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$taskRepository = $em->getRepository("AppBundle:Task");


    	$task = $taskRepository->findOneBy(['name' => "Installer Symfony"]);
    	$comment = new TaskComment();
    	$comment->setContent("salut, ça va ?");
    	$task->addComment($comment);

    	/** @var TaskComment $comment */
    	$comment = $task->getComments()[0];
    	var_dump($comment->getContent());

//    	$em->persist($comment);
//    	$em->flush();

//    	var_dump($task->getName());
//    	var_dump($task->getId());
//    	var_dump($task->getDate());

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
