<?php

namespace LoggerBundle\EventListener;

use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use BeerScoreBundle\Event\ReviewDoneEvent;
use Psr\Log\LoggerInterface;

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

    public function handleReviewDone(ReviewDoneEvent $event)
    {
        $review = $event->getReview();
        $this->logger->info('New review for '
            . $review->getBeer()->getName()
            . ' with a overall score of '
            . $review->getOverallScore());
    }
}