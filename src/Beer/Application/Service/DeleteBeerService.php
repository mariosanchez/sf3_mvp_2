<?php

namespace BeerScore\Beer\Application\Service;

use BeerScore\Beer\Domain\Model\Beer;
use BeerScore\Beer\Domain\Model\BeerRepository;

class DeleteBeerService
{

    /**
     * GetBeersService constructor.
     * @param BeerRepository $repository
     */
    public function __construct(
        BeerRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Creates new beer from given data
     *
     * @param $data
     * @return Beer
     */
    public function __invoke($data)
    {
        $beer = $this->repository->findById($data['id']);

        $this->repository->remove($beer);
    }
}
