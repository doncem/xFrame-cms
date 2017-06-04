<?php

namespace XframeCMS\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * XframeCMS\Model\Action
 *
 * @ORM\Entity(repositoryClass="ActionRepository")
 * @ORM\Table(name="_action", uniqueConstraints={@ORM\UniqueConstraint(name="action_name", columns={"`name`"})})
 */
class Action extends XframeCMS\AbstractModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="`name`", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="UserAudit", inversedBy="actions")
     * @ORM\JoinColumn(name="id", referencedColumnName="action_id", nullable=false)
     */
    protected $userAudit;

    public function __construct()
    {
    }

    public function __sleep()
    {
        return array('id', 'name');
    }
}