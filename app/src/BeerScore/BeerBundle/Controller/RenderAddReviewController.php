<?php

namespace BeerScore\BeerBundle\Controller;

use BeerScore\Beer\Application\Service\GetBeerService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use BeerScore\ReviewBundle\Entity\Review;

/**
 * Beer controller.
 */
class RenderAddReviewController extends Controller
{

    /**
     * @var GetBeerService
     */
    private $service;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * CreateController constructor.
     * @param ContainerInterface $container
     * @param GetBeerService $service
     */
    public function __construct(
        ContainerInterface $container,
        GetBeerService $service
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

        $beer = ($this->service)($request->attributes->all());

        return $this->render('BeerScoreBeerBundle:Beer:addReview.html.twig', array(
            'beer' => $beer,
            'review_form' => $reviewForm->createView(),
        ));
    }
}
