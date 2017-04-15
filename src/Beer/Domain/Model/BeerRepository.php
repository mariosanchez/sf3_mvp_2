<?php

namespace BeerScore\Beer\Domain\Model;

interface BeerRepository
{
    /**
     * Returns entity with given id
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * Returns all entities
     * @return array
     */
    public function findAll();

    /**
     * Persists a beer
     * @param Beer $beer
     */
    public function save(Beer $beer);
}
