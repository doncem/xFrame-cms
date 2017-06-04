<?php

namespace XframeCMS\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * XframeCMS\Model\Page
 *
 * @ORM\Entity(repositoryClass="PageRepository")
 * @ORM\Table(name="_page", indexes={@ORM\Index(name="page_author_id", columns={"author_id"})}, uniqueConstraints={@ORM\UniqueConstraint(name="url_param_UNIQUE", columns={"`view`"})})
 */
class Page extends XframeCMS\AbstractModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="`view`", type="string", length=100)
     */
    protected $view;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    protected $author_id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updated;

    /**
     * @ORM\Column(type="boolean", options={"unsigned":true})
     */
    protected $is_published;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $controller;

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

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function __sleep()
    {
        return array('id', 'view', 'author_id', 'created', 'updated', 'is_published', 'controller');
    }
}