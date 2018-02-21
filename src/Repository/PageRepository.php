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

    public function getPageById(string $pageId = null)
    {
        if (null === $pageId) {
            return null;
        }

        $this->findBy([
            'id' => $pageId
        ]);
    }
}
