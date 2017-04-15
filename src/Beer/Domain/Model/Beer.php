<?php

namespace BeerScore\Beer\Domain\Model;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use BeerScore\ReviewBundle\Entity\Review;

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
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBrewery(): ?string
    {
        return $this->brewery;
    }

    /**
     * @param string $brewery
     */
    public function setBrewery(string $brewery)
    {
        $this->brewery = $brewery;
    }

    /**
     * @return string
     */
    public function getStyle(): ?string
    {
        return $this->style;
    }

    /**
     * @param string $style
     */
    public function setStyle(string $style)
    {
        $this->style = $style;
    }

    /**
     * @return float
     */
    public function getAbv(): ?float
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
     * @return string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getPhoto(): ?string
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
     * @return float|null
     */
    public function getScore(): ?float
    {
        return $this->score;
    }

    /**
     * @param float $score
     */
    public function setScore(float $score)
    {
        $this->score = $score;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param Review $review
     */
    public function addReview(Review $review)
    {
        $this->reviews[] = $review;
        $review->setBeer($this);
        $this->processScore();
    }

    /**
     * @return Collection|null
     */
    public function getReviews(): ?Collection
    {
        return $this->reviews;
    }

    /**
     * Updates updatedAt value on update
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));
    }

    /**
     * Process the score of a beer based on it's reviews
     */
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

