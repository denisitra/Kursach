<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
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
     * @ORM\Column(type="string", length=1800)
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
     * @return string|null
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @return string|null
     */
    public function setHeadline($headline)
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

    /**
     * @return string|null
     */
    public function setTeaser($teaser)
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

    /**
     * @return string|null
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
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

    /**
     * @return string|null
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return integer|null
     */
    public function getId()
    {
        return $this->id;
    }





}