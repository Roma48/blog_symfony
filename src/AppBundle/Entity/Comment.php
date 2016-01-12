<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Comment
 * @package AppBundle\Entity
 * @ORM\Entity()
 * @ORM\Table()
 */
class Comment
{
    /**
     * @var Integer
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var String
     * @ORM\Column(type="text")
     */
    protected $message;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="User", inversedBy="id")
     */
    protected $user;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="id")
     */
    protected $article;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param String $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}