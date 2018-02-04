<?php

namespace XframeCMS\Model\Db;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * XframeCMS\Model\Db\Page
 *
 * @ORM\Entity(repositoryClass="XframeCMS\Repository\PageRepository")
 * @ORM\Table(name="_page", indexes={@ORM\Index(name="page_author_id", columns={"author_id"})}, uniqueConstraints={@ORM\UniqueConstraint(name="url_param_UNIQUE", columns={"url_param"})})
 */
class Page extends \XframeCMS\Model\AbstractModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $url_param;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    protected $author_id;

    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    protected $created = CURRENT_TIMESTAMP;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updated;

    /**
     * @ORM\Column(type="boolean", options={"unsigned":true, "default":"0"})
     */
    protected $is_published = false;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $controller;

    /**
     * @ORM\Column(type="integer", options={"default":"0"})
     */
    protected $total_points = 0;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="page")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     */
    protected $users;

    /**
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="pages")
     * @ORM\JoinColumn(name="id", referencedColumnName="page_id", nullable=false)
     */
    protected $menu;

    /**
     * @ORM\ManyToOne(targetEntity="PagePointLog", inversedBy="pages")
     * @ORM\JoinColumn(name="id", referencedColumnName="page_id", nullable=false)
     */
    protected $pagePointLog;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function __sleep()
    {
        return array('id', 'url_param', 'author_id', 'created', 'updated', 'is_published', 'controller', 'total_points');
    }
}