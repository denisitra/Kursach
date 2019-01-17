<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=180)
     */
    protected $headline;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=180)
     */
    protected $teaser;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=10000)
     */
    protected $text;

    /**
     * @ORM\Column()
     */
    protected $image;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=180)
     */
    protected $tags;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="post")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    /**
     * @var Comment[]|ArrayCollection
     *
     * @ORM\OneToMany(
     *      targetEntity="Comment",
     *      mappedBy="post",
     * )
     */
    private $comments;


    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }


    public function getComments(): Collection
    {
        return $this->comments;
    }
    public function addComment(Comment $comment): void
    {
        $comment->setPost($this);
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
        }
    }
    public function removeComment(Comment $comment): void
    {
        $this->comments->removeElement($comment);
    }


    /**
     * @return string|null
     */
    public function getHeadline()
    {
        return $this->headline;
    }


    public function setHeadline($headline) : void
    {
        $this->headline = $headline;
    }

    /**
     * @return string|null
     */
    public function getTeaser()
    {
        return $this->teaser;
    }


    public function setTeaser($teaser) :void
    {
        $this->teaser = $teaser;
    }

    /**
     * @return string|null
     */
    public function getText()
    {
        return $this->text;
    }


    public function setText($text) : void
    {
        $this->text = $text;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image) : void
    {
        $this->image = $image;
    }

    /**
     * @return string|null
     */
    public function getTags()
    {
        return $this->tags;
    }


    public function setTags($tags) : void
    {
        $this->tags = $tags;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }



}