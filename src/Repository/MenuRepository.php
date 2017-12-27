<?php

namespace XframeCMS\Repository;

use Doctrine\ORM\EntityRepository;

class MenuRepository extends EntityRepository
{
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
