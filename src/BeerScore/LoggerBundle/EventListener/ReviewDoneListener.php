<?php

namespace BeerScore\LoggerBundle\EventListener;

use BeerScore\ReviewBundle\Event\ReviewDoneEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ReviewDoneListener implements EventSubscriberInterface
{
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            ReviewDoneEvent::NAME => 'handleReviewDone'
        ];
    }

    /**
     * Handle incomming events on review done
     *
     * @param ReviewDoneEvent $event
     */
    public function handleReviewDone(ReviewDoneEvent $event)
    {
        $review = $event->getReview();
        $this->logger->info('New review for '
            . $review->getBeer()->getName()
            . ' with a overall score of '
            . $review->getOverallScore());
    }
}