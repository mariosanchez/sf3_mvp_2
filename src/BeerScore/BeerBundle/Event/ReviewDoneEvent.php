<?php

namespace BeerScore\BeerBundle\Event;

use BeerScore\BeerBundle\Entity\Review;
use Symfony\Component\EventDispatcher\Event;


class ReviewDoneEvent extends Event
{
    const NAME = 'review.done';

    protected $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function getReview()
    {
        return $this->review;
    }
}