<?php

namespace XframeCMS\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Page update log repository.
 */
class PageUpdateLogRepository extends EntityRepository
{
    /**
     * Get all pages.
     *
     * @param int|null $pageId
     *
     * @return array
     */
    public function getAllByPageId(int $pageId = null)
    {
        if (null === $pageId) {
            return [];
        }

        return $this->findBy([
            'page_id' => $pageId
        ]);
    }
}
