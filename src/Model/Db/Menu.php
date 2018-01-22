<?php

namespace XframeCMS\Model\Db;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * XframeCMS\Model\Db\Menu
 *
 * @ORM\Entity(repositoryClass="XframeCMS\Repository\MenuRepository")
 * @ORM\Table(name="_menu", indexes={@ORM\Index(name="menu_page_id", columns={"page_id"}), @ORM\Index(name="menu_parent_id", columns={"parent_id"})})
 */
class Menu extends \XframeCMS\Model\AbstractModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    protected $page_id;

    /**
     * @ORM\Column(name="`name`", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $view_order;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"unsigned":true})
     */
    protected $parent_id;

    /**
     * @ORM\Column(type="boolean", options={"unsigned":true, "default":"1"})
     */
    protected $is_active = 1;

    /**
     * @ORM\OneToMany(targetEntity="Page", mappedBy="menu")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id", nullable=false)
     */
    protected $pages;

    /**
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="menu")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $menus;

    /**
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="menus")
     * @ORM\JoinColumn(name="id", referencedColumnName="parent_id", nullable=false)
     */
    protected $menu;

    public function __construct()
    {
        $this->pages = new ArrayCollection();
        $this->menus = new ArrayCollection();
    }

    public function __sleep()
    {
        return array('id', 'page_id', 'name', 'view_order', 'parent_id', 'is_active');
    }
}