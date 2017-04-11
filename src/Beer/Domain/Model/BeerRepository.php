<?php

namespace BeerScore\Beer\Domain\Model;

use Doctrine\Common\Collections\Collection;

interface BeerRepository
{
    /**
     * Returns all entities
     * @return Collection
     */
    public function findAll();
}
