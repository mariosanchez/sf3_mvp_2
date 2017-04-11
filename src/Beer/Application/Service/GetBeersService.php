<?php

namespace BeerScore\Beer\Application\Service;

use BeerScore\Beer\Domain\Model\BeerRepository;

class GetBeersService
{
    /**
     * @var BeerRepository
     */
    private $repository;

    /**
     * GetBeersService constructor.
     * @param BeerRepository $repository
     */
    public function __construct(
        BeerRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function __invoke()
    {

        return $this->repository->findAll();
    }
}