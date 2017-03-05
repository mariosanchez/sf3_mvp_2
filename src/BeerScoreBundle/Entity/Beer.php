<?php

namespace BeerScoreBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Beer
 */
class Beer
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $brewery;

    /**
     * @var string
     */
    private $style;

    /**
     * @var float
     */
    private $abv;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $photo;

    /**
     * @var float
     */
    private $score;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var Collection
     */
    private $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Beer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set brewery
     *
     * @param string $brewery
     *
     * @return Beer
     */
    public function setBrewery($brewery)
    {
        $this->brewery = $brewery;

        return $this;
    }

    /**
     * Get brewery
     *
     * @return string
     */
    public function getBrewery()
    {
        return $this->brewery;
    }

    /**
     * Set style
     *
     * @param string $style
     *
     * @return Beer
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @return float
     */
    public function getAbv()
    {
        return $this->abv;
    }

    /**
     * @param float $abv
     */
    public function setAbv(float $abv)
    {
        $this->abv = $abv;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Beer
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto(string $photo)
    {
        $this->photo = $photo;
    }

    /**
     * Set score
     *
     * @param integer $score
     *
     * @return Beer
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Beer
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Beer
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function addReview(Review $review)
    {
        $this->reviews[] = $review;
        $review->setBeer($this);
        $this->processScore();
    }

    /**
     * @return Collection
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    public function processScore()
    {
        $totalReviews = $this->reviews->count();
        if (1 === $totalReviews) {
            $this->score = $this->reviews->last()->getOverallScore();
            return;
        }
        $oldSummatory = ($this->score * ($totalReviews - 1));
        $newSummatory = $oldSummatory + $this->reviews->last()->getOverallScore();
        $this->score  = $newSummatory / $totalReviews;
    }
}

