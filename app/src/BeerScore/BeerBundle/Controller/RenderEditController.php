<?php

namespace BeerScore\BeerBundle\Controller;

use BeerScore\Beer\Application\Service\GetBeerService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Beer controller.
 */
class RenderEditController extends Controller
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
     * RenderEditController constructor.
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

    public function renderFormAction(Request $request)
    {

        $beer = ($this->service)([
            'id' => $request->attributes->get('id'),
        ]);

        return $this->render('BeerScoreBeerBundle:Beer:edit.html.twig', array('beer' => $beer));
    }
}
