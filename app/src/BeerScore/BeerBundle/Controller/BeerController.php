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
     * Displays a form to edit an existing beer entity.
     *
     * @param Request $request
     * @param Beer $beer
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Beer $beer)
    {
        $deleteForm = $this->createDeleteForm($beer);
        $editForm = $this->createForm('BeerScore\BeerBundle\Form\BeerType', $beer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('beer_edit', array('id' => $beer->getId()));
        }

        return $this->render('BeerScoreBeerBundle:Beer:edit.html.twig', array(
            'beer' => $beer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a beer entity.
     *
     * @param Request $request
     * @param Beer $beer
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Beer $beer)
    {
        $form = $this->createDeleteForm($beer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($beer);
            $entityManager->flush($beer);
        }

        return $this->redirectToRoute('beer_index');
    }

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

    /**
     * Creates a form to delete a beer entity.
     *
     * @param Beer $beer The beer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Beer $beer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('beer_delete', array('id' => $beer->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
