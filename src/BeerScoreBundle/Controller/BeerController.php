<?php

namespace BeerScoreBundle\Controller;

use BeerScoreBundle\Entity\Beer;
use BeerScoreBundle\Entity\Review;
use BeerScoreBundle\Event\ReviewDoneEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;

/**
 * Beer controller.
 */
class BeerController extends Controller
{
    /**
     * Lists all beer entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $beers = $em->getRepository('BeerScoreBundle:Beer')->findAll();

        return $this->render('BeerScoreBundle:Beer:index.html.twig', array(
            'beers' => $beers,
        ));
    }

    /**
     * Creates a new beer entity.
     */
    public function newAction(Request $request)
    {
        $beer = new Beer();
        $form = $this->createForm('BeerScoreBundle\Form\BeerType', $beer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($beer);
            $em->flush($beer);

            return $this->redirectToRoute('beer_show', array('id' => $beer->getId()));
        }

        return $this->render('BeerScoreBundle:Beer:new.html.twig', array(
            'beer' => $beer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a beer entity.
     */
    public function showAction(Beer $beer)
    {
        $deleteForm = $this->createDeleteForm($beer);

        return $this->render('BeerScoreBundle:Beer:show.html.twig', array(
            'beer' => $beer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing beer entity.
     */
    public function editAction(Request $request, Beer $beer)
    {
        $deleteForm = $this->createDeleteForm($beer);
        $editForm = $this->createForm('BeerScoreBundle\Form\BeerType', $beer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('beer_edit', array('id' => $beer->getId()));
        }

        return $this->render('BeerScoreBundle:Beer:edit.html.twig', array(
            'beer' => $beer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a beer entity.
     */
    public function deleteAction(Request $request, Beer $beer)
    {
        $form = $this->createDeleteForm($beer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($beer);
            $em->flush($beer);
        }

        return $this->redirectToRoute('beer_index');
    }

    /**
     * Adds a review entity to a beer entity.
     */
    public function addReviewAction(Request $request, Beer $beer)
    {
        $review = new Review();
        $reviewForm = $this->createForm('BeerScoreBundle\Form\ReviewType', $review);
        $reviewForm->handleRequest($request);

        if ($reviewForm->isSubmitted() && $reviewForm->isValid()) {
            $review->processOverallScore();
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $beer->addReview($review);
            $em->flush();
            $event = new ReviewDoneEvent($review);
            $this->get('event_dispatcher')->dispatch(ReviewDoneEvent::NAME, $event);
            return $this->redirectToRoute('beer_show', array('id' => $beer->getId()));
        }

        return $this->render('BeerScoreBundle:Beer:addReview.html.twig', array(
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
            ->getForm()
        ;
    }
}
