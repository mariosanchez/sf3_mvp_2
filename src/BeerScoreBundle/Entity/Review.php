<?php

namespace BeerScoreBundle\Entity;

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
     * Set title
     *
     * @param string $title
     *
     * @return Review
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Review
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
     * Set userName
     *
     * @param string $userName
     *
     * @return Review
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set aromaScore
     *
     * @param integer $aromaScore
     *
     * @return Review
     */
    public function setAromaScore($aromaScore)
    {
        $this->aromaScore = $aromaScore;

        return $this;
    }

    /**
     * Get aromaScore
     *
     * @return int
     */
    public function getAromaScore()
    {
        return $this->aromaScore;
    }

    /**
     * Set appearanceScore
     *
     * @param integer $appearanceScore
     *
     * @return Review
     */
    public function setAppearanceScore($appearanceScore)
    {
        $this->appearanceScore = $appearanceScore;

        return $this;
    }

    /**
     * Get appearanceScore
     *
     * @return int
     */
    public function getAppearanceScore()
    {
        return $this->appearanceScore;
    }

    /**
     * Set tasteScore
     *
     * @param integer $tasteScore
     *
     * @return Review
     */
    public function setTasteScore($tasteScore)
    {
        $this->tasteScore = $tasteScore;

        return $this;
    }

    /**
     * Get tasteScore
     *
     * @return int
     */
    public function getTasteScore()
    {
        return $this->tasteScore;
    }

    /**
     * Set palateScore
     *
     * @param integer $palateScore
     *
     * @return Review
     */
    public function setPalateScore($palateScore)
    {
        $this->palateScore = $palateScore;

        return $this;
    }

    /**
     * Get palateScore
     *
     * @return int
     */
    public function getPalateScore()
    {
        return $this->palateScore;
    }

    /**
     * Set overallScore
     *
     * @param integer $overallScore
     *
     * @return Review
     */
    public function setOverallScore($overallScore)
    {
        $this->overallScore = $overallScore;

        return $this;
    }

    /**
     * Get overallScore
     *
     * @return int
     */
    public function getOverallScore()
    {
        return $this->overallScore;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Review
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
     * @return Review
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

    /**
     * @return Beer
     */
    public function getBeer()
    {
        return $this->beer;
    }

    /**
     * @param Beer $beer
     */
    public function setBeer(Beer $beer)
    {
        $this->beer = $beer;
    }

    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    public function processOverallScore()
    {
        $scoreSummatory = $this->getAppearanceScore() +
            $this->getAromaScore() +
            $this->getPalateScore() +
            $this->getTasteScore();

        $this->overallScore = ($scoreSummatory / self::TOTAL_SUB_SCORES);

    }
}

