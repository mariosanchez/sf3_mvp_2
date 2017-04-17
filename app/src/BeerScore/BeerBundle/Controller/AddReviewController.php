<?php

namespace BeerScore\BeerBundle\Controller;

use BeerScore\ReviewBundle\Entity\Review;
use BeerScore\ReviewBundle\Event\ReviewDoneEvent;
use BeerScore\Beer\Application\Service\AddReviewService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Beer controller.
 */
class AddReviewController extends Controller
{

    /**
     * @var AddReviewService
     */
    private $service;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * CreateController constructor.
     * @param ContainerInterface $container
     * @param AddReviewService $service
     */
    public function __construct(
        ContainerInterface $container,
        AddReviewService $service
    ) {
        $this->service = $service;
        $this->container = $container;
    }

    /**
     * Adds a review entity to a beer entity.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addReviewAction(Request $request)
    {
        $review = new Review();
        $reviewForm = $this->createForm('BeerScore\ReviewBundle\Form\ReviewType', $review);
        $reviewForm->handleRequest($request);

        if ($reviewForm->isSubmitted() && $reviewForm->isValid()) {
            $review->processOverallScore();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($review);
            ($this->service)([
                'id' => $request->attributes->get('id'),
                'review' => $review,
            ]);
            $event = new ReviewDoneEvent($review);
            $this->get('event_dispatcher')->dispatch(ReviewDoneEvent::NAME, $event);

            return $this->redirectToRoute('beer_show', array('id' => $request->attributes->get('id')));
        }
    }
}
