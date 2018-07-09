<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaskComment
 *
 * @ORM\Table(name="task_comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaskCommentRepository")
 */
class TaskComment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	/**
	 * @var Task
	 *
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Task", inversedBy="comments")
	 */
    protected $task;
	/**
	 * @var string
	 *
	 * @ORM\Column(name="content", type="string")
	 */
    protected $content;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return TaskComment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set task
     *
     * @param \AppBundle\Entity\Task $task
     *
     * @return TaskComment
     */
    public function setTask(\AppBundle\Entity\Task $task = null)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return \AppBundle\Entity\Task
     */
    public function getTask()
    {
        return $this->task;
    }
}
