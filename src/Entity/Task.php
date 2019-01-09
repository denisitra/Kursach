<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Task
{

    /**
     * @Assert\NotBlank
     */
    protected $headline;

    /**
     * @Assert\NotBlank
     */
    protected $teaser;

    /**
     * @Assert\NotBlank
     */
    protected $text;

    /**
     * @Assert\NotBlank
     */
    protected $image;

    /**
     * @Assert\NotBlank
     */
    protected $tags;


    public function getHeadline()
    {
        return $this->headline;
    }

    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }


    public function getTeaser()
    {
        return $this->teaser;
    }

    public function setTeaser($teaser)
    {
        $this->teaser = $teaser;
    }

    public function getText()
    {
        return $this->text;
    }

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

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }


}