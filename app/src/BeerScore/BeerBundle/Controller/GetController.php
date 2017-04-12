<?php

namespace BeerScore\BeerBundle\Controller;

use BeerScore\Beer\Application\Service\GetBeerService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use BeerScore\Beer\Domain\Model\Beer;

/**
 * Beer controller.
 */
class GetController extends Controller
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
     * GetAllController constructor.
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
     * Finds and displays a beer entity.
     *
     * @param $request Request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request)
    {
        $beer = ($this->service)([
            'id' => $request->attributes->get('id'),
        ]);

        return $this->render('BeerScoreBeerBundle:Beer:show.html.twig', array(
            'beer' => $beer,
        ));
    }
}
