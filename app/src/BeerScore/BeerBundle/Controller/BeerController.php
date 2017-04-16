<?php

namespace BeerScore\BeerBundle\Controller;

use BeerScore\Beer\Domain\Model\Beer;
use BeerScore\ReviewBundle\Entity\Review;
use BeerScore\ReviewBundle\Event\ReviewDoneEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Beer controller.
 */
class BeerController extends Controller
{


    /**
     * Adds a review entity to a beer entity.
     *
     * @param Request $request
     * @param Beer $beer
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addReviewAction(Request $request, Beer $beer)
    {
        $review = new Review();
        $reviewForm = $this->createForm('BeerScore\ReviewBundle\Form\ReviewType', $review);
        $reviewForm->handleRequest($request);

        if ($reviewForm->isSubmitted() && $reviewForm->isValid()) {
            $review->processOverallScore();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($review);
            $beer->addReview($review);
            $entityManager->flush();
            $event = new ReviewDoneEvent($review);
            $this->get('event_dispatcher')->dispatch(ReviewDoneEvent::NAME, $event);
            return $this->redirectToRoute('beer_show', array('id' => $beer->getId()));
        }

        return $this->render('BeerScoreBeerBundle:Beer:addReview.html.twig', array(
            'beer' => $beer,
            'review_form' => $reviewForm->createView(),
        ));
    }
}
