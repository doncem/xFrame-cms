<?php

namespace XframeCMS\Model\Db;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * XframeCMS\Model\Db\PagePointLog
 *
 * @ORM\Entity(repositoryClass="XframeCMS\Repository\PagePointLogRepository")
 * @ORM\Table(name="_page_point_log", indexes={@ORM\Index(name="page_point_user", columns={"user_id"}), @ORM\Index(name="page_point_page", columns={"page_id"})})
 */
class PagePointLog extends \XframeCMS\Model\AbstractModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    protected $user_id;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    protected $page_id;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $point;

    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    protected $created = CURRENT_TIMESTAMP;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="pagePointLog")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $users;

    /**
     * @ORM\OneToMany(targetEntity="Page", mappedBy="pagePointLog")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id", nullable=false)
     */
    protected $pages;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->pages = new ArrayCollection();
    }

    public function __sleep()
    {
        return array('id', 'user_id', 'page_id', 'point', 'created');
    }
}