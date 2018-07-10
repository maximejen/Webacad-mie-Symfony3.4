<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/tasks")
 *
 * Class TaskController
 * @package AppBundle\Controller
 */
class TaskController extends Controller
{
	/**
	 * @Route("/", name="list_tasks", methods={"GET"})
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function listAction()
	{
		$em = $this->getDoctrine()->getManager();
		$taskRepository = $em->getRepository("AppBundle:Task");

		$tasks = $taskRepository->findAll();
		return $this->render('Tasks/index.html.twig', [
			'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
			'tasks' => $tasks
		]);
	}

	/**
	 * @Route("/new", name="create_task", methods={"GET|POST"})
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function addAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$taskRepository = $em->getRepository("AppBundle:Task");
		$form = $this->createForm(TaskType::class);
		$form->handleRequest($request);
		if ($request->isMethod("POST")) {
			if ($form->isValid()) {
				/** @var Task $newTask */
				$newTask = $form->getData();
				$newTask->setCreatedAt(new \DateTime);

				$em->persist($newTask);
				$em->flush();

				return $this->redirectToRoute("list_tasks");
			}
		}
		return $this->render('Tasks/create.html.twig', [
			'form' => $form->createView()
		]);
	}
}
