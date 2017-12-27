<?php

namespace XframeCMS\Model\Db;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * XframeCMS\Model\Db\UserAudit
 *
 * @ORM\Entity(repositoryClass="UserAuditRepository")
 * @ORM\Table(name="_user_audit", indexes={@ORM\Index(name="user_audit_action", columns={"action_id"}), @ORM\Index(name="user_audit_user", columns={"audited_user_id"})})
 */
class UserAudit extends \XframeCMS\Model\Db\AbstractModel
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
    protected $audited_user_id;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $action_id;

    /**
     * @ORM\Column(name="`data`", type="text", nullable=true)
     */
    protected $data;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    protected $user_id;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="userAudit")
     * @ORM\JoinColumn(name="audited_user_id", referencedColumnName="id", nullable=false)
     */
    protected $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function __sleep()
    {
        return array('id', 'audited_user_id', 'action_id', 'data', 'created', 'user_id');
    }
}
