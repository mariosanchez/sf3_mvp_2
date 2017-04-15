<?php

namespace BeerScore\Beer\Application\Service;

use BeerScore\Beer\Domain\Model\Beer;
use BeerScore\Beer\Domain\Model\BeerRepository;

class PutBeerService
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
        if (!isset($beer)) {
            throw new \InvalidArgumentException();
        }
        $beer->setName($data['name']);
        $beer->setBrewery($data['brewery']);
        $beer->setStyle($data['style']);
        $beer->setAbv($data['abv']);
        $beer->setCountry($data['country']);
        $beer->setPhoto($data['photo']);

        return $this->repository->save($beer);
    }
}
