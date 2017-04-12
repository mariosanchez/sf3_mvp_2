<?php

namespace BeerScore\Beer\Application\Service;

use BeerScore\Beer\Domain\Model\BeerRepository;

class GetBeerService
{
    /**
     * @var BeerRepository
     */
    private $repository;

    /**
     * GetBeerService constructor.
     * @param BeerRepository $repository
     */
    public function __construct(
        BeerRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function __invoke($data)
    {

        return $this->repository->find($data['id']);
    }
}