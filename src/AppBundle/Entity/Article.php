<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use AppBundle\Entity\Category;

/**
 * @ORM\Entity()
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 */
class Article
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     *
     */
    protected $title;

    /**
     * @ORM\Column()
     * @Gedmo\Slug(fields={"title"})
     */
    protected $slug;

    /**
     * @var
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @var
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="id")
     */
    protected $category;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="id")
     */
    protected $comments;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="User", inversedBy="firstName")
     */
    protected $author;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="Like", mappedBy="id")
     */
    protected $likes;

    /**
     * @var
     * @ORM\Column(type="integer")
     */
    protected $views;

    /**
     * @var String
     * @ORM\OneToOne(targetEntity="Image", mappedBy="id")
     */
    protected $image;


    public function __construct()
    {
        $this->likes = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param User $author
     * @return $this
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Comment $comment
     * @return $this
     */
    public function addComments(Comment $comment)
    {
        $comment->setComment($this);
        $this->comments->add($comment);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLike()
    {
        return $this->like;
    }

    /**
     * @param Like $like
     * @return $this
     */
    public function addLike(Like $like)
    {
        $like->setLike($this);
        $this->likes->add($like);
        return $this;
    }

    /**
     * @param Like $like
     */
    public function removeLike(Like $like)
    {
        $this->like->removeElement($like);
    }

    /**
     * @return mixed
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param mixed $views
     */
    public function setViews($views)
    {
        $this->views = $views;
    }

    /**
     * @return String
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param String $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

}