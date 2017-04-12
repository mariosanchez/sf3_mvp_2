<?php

namespace BeerScore\ReviewBundle\Entity;

use BeerScore\Beer\Domain\Model\Beer;

/**
 * Review
 */
class Review
{
    const TOTAL_SUB_SCORES = 4;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $userName;

    /**
     * @var int
     */
    private $aromaScore;

    /**
     * @var int
     */
    private $appearanceScore;

    /**
     * @var int
     */
    private $tasteScore;

    /**
     * @var int
     */
    private $palateScore;

    /**
     * @var float
     */
    private $overallScore;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    private $beer;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return int
     */
    public function getId(): int
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
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return int
     */
    public function getAromaScore(): ?int
    {
        return $this->aromaScore;
    }

    /**
     * @param int $aromaScore
     */
    public function setAromaScore(int $aromaScore)
    {
        $this->aromaScore = $aromaScore;
    }

    /**
     * @return int
     */
    public function getAppearanceScore(): ?int
    {
        return $this->appearanceScore;
    }

    /**
     * @param int $appearanceScore
     */
    public function setAppearanceScore(int $appearanceScore)
    {
        $this->appearanceScore = $appearanceScore;
    }

    /**
     * @return int
     */
    public function getTasteScore(): ?int
    {
        return $this->tasteScore;
    }

    /**
     * @param int $tasteScore
     */
    public function setTasteScore(int $tasteScore)
    {
        $this->tasteScore = $tasteScore;
    }

    /**
     * @return int
     */
    public function getPalateScore(): ?int
    {
        return $this->palateScore;
    }

    /**
     * @param int $palateScore
     */
    public function setPalateScore(int $palateScore)
    {
        $this->palateScore = $palateScore;
    }

    /**
     * @return float
     */
    public function getOverallScore(): ?float
    {
        return $this->overallScore;
    }

    /**
     * @param float $overallScore
     */
    public function setOverallScore(float $overallScore)
    {
        $this->overallScore = $overallScore;
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
     * @return mixed
     */
    public function getBeer(): ?Beer
    {
        return $this->beer;
    }

    /**
     * @param mixed $beer
     */
    public function setBeer(Beer $beer)
    {
        $this->beer = $beer;
    }



    /**
     * Updates updatedAt value on update
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));
    }

    /**
     * Process the overll score of a review based on it's scores
     */
    public function processOverallScore()
    {
        $scoreSummatory = $this->getAppearanceScore() +
            $this->getAromaScore() +
            $this->getPalateScore() +
            $this->getTasteScore();

        $this->overallScore = ($scoreSummatory / self::TOTAL_SUB_SCORES);

    }
}

