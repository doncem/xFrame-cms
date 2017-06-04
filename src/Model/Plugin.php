<?php

namespace XframeCMS\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * XframeCMS\Model\Plugin
 *
 * @ORM\Entity(repositoryClass="PluginRepository")
 * @ORM\Table(name="_plugin")
 */
class Plugin extends XframeCMS\AbstractModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="`name`", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(name="`class`", type="string", length=100)
     */
    protected $class;

    /**
     * @ORM\Column(type="boolean", options={"unsigned":true})
     */
    protected $is_enabled;

    public function __construct()
    {
    }

    public function __sleep()
    {
        return array('id', 'name', 'class', 'is_enabled');
    }
}