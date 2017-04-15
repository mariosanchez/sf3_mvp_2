<?php

namespace BeerScore\BeerBundle\Controller;

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

    public function renderFormAction()
    {

        return $this->render('BeerScoreBeerBundle:Beer:new.html.twig', array());
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
        $beer = ($this->service)($request->request->all());

        return $this->redirectToRoute('beer_show', array('id' => $beer->getId()));
    }
}
