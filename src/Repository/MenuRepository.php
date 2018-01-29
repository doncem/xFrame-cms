<?php

namespace XframeCMS\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Menu repository.
 */
class MenuRepository extends EntityRepository
{
    /**
     * Get active menu, sort by parent_id ASC, view_order ASC.
     */
    public function getActive()
    {
        return $this->findBy([
            'is_active' => true
        ], [
            'parent_id' => 'ASC',
            'view_order' => 'ASC'
        ]);
    }
}
