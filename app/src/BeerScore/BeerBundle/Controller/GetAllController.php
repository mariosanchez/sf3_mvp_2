<?php

namespace BeerScore\BeerBundle\Controller;

use BeerScore\Beer\Application\Service\GetBeersService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Beer controller.
 */
class GetAllController extends Controller
{

    /**
     * @var GetBeersService
     */
    private $service;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * GetAllController constructor.
     * @param ContainerInterface $container
     * @param GetBeersService $service
     */
    public function __construct(
        ContainerInterface $container,
        GetBeersService $service
    ) {
        $this->service = $service;
        $this->container = $container;
    }

    /**
     * Lists all beer entities.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $beers = ($this->service)();

        return $this->render('BeerScoreBeerBundle:Beer:index.html.twig', array(
            'beers' => $beers,
        ));
    }
}
