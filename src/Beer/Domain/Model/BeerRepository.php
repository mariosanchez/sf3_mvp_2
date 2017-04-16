<?php

namespace BeerScore\Beer\Domain\Model;

interface BeerRepository
{
    /**
     * Returns entity with given id
     *
     * @param int $id
     * @return null|Beer
     */
    public function findById(int $id);

    /**
     * Returns all entities
     *
     * @param array $orderBy
     * @return array
     */
    public function findAll(array $orderBy = null);

    /**
     * Persists a beer
     *
     * @param Beer $beer
     * @return Beer
     */
    public function save(Beer $beer): Beer;

    /**
     * Removes a beer
     *
     * @param Beer $beer
     */
    public function remove(Beer $beer);
}
