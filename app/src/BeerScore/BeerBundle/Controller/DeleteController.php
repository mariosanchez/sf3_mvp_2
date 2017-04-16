<?php

namespace BeerScore\BeerBundle\Controller;

use BeerScore\Beer\Application\Service\DeleteBeerService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Beer controller.
 */
class DeleteController extends Controller
{

    /**
     * @var DeleteBeerService
     */
    private $service;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * DeleteController constructor.
     * @param ContainerInterface $container
     * @param DeleteBeerService $service
     */
    public function __construct(
        ContainerInterface $container,
        DeleteBeerService $service
    ) {
        $this->service = $service;
        $this->container = $container;
    }

    /**
     * Deletes a beer entity.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request)
    {
        ($this->service)($request->attributes->all());

        return $this->redirectToRoute('beer_index');
    }
}
