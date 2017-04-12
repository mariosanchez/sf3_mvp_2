<?php

namespace BeerScore\BeerBundle\Controller;

use BeerScore\Beer\Domain\Model\Beer;
use BeerScore\Beer\Application\Service\PostBeerService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Beer controller.
 */
class CreateController extends Controller
{

    /**
     * @var PostBeerService
     */
    private $service;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * CreateController constructor.
     * @param ContainerInterface $container
     * @param PostBeerService $service
     */
    public function __construct(
        ContainerInterface $container,
        PostBeerService $service
    ) {
        $this->service = $service;
        $this->container = $container;
    }

    /**
     * Creates a new beer entity.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        ($this->service)();
        $beer = new Beer();
        $form = $this->createForm('BeerScore\BeerBundle\Form\BeerType', $beer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($beer);
            $entityManager->flush($beer);

            return $this->redirectToRoute('beer_show', array('id' => $beer->getId()));
        }

        return $this->render('BeerScoreBeerBundle:Beer:new.html.twig', array(
            'beer' => $beer,
            'form' => $form->createView(),
        ));
    }
}
