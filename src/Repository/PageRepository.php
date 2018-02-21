<?php

namespace XframeCMS\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Page repository.
 */
class PageRepository extends EntityRepository
{
    /**
     * Get all pages.
     */
    public function getAll()
    {
        return $this->findAll();
    }
}
