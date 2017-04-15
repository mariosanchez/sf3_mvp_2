<?php

namespace BeerScore\BeerBundle\Controller;

use BeerScore\Beer\Application\Service\PutBeerService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Beer controller.
 */
class EditController extends Controller
{

    /**
     * @var PutBeerService
     */
    private $service;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * EditController constructor.
     * @param ContainerInterface $container
     * @param PutBeerService $service
     */
    public function __construct(
        ContainerInterface $container,
        PutBeerService $service
    ) {
        $this->service = $service;
        $this->container = $container;
    }

    /**
     * Edits an existing beer entity.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request)
    {
        $data = $request->request->all();
        $data['id'] = $request->attributes->get('id');
        $beer = ($this->service)($data);

        return $this->redirectToRoute('beer_show', array('id' => $beer->getId()));
    }
}
