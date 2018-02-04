<?php

namespace XframeCMS\Model\Db;

use Doctrine\ORM\Mapping as ORM;

/**
 * XframeCMS\Model\Db\User
 *
 * @ORM\Entity(repositoryClass="XframeCMS\Repository\UserRepository")
 * @ORM\Table(name="_user", uniqueConstraints={@ORM\UniqueConstraint(name="user_email", columns={"email"})})
 */
class User extends \XframeCMS\Model\AbstractModel
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
    protected $email;

    /**
     * @ORM\Column(name="`password`", type="string", length=72, nullable=true, options={"default":"NULL"})
     */
    protected $password;

    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    protected $registered = CURRENT_TIMESTAMP;

    /**
     * @ORM\Column(type="string", length=44)
     */
    protected $last_session;

    /**
     * time to live in minutes
     *
     * @ORM\Column(type="smallint", options={"unsigned":true, "default":"30"})
     */
    protected $session_ttl = 30;

    /**
     * @ORM\Column(type="boolean", options={"unsigned":true, "default":"0"})
     */
    protected $is_admin = false;

    /**
     * @ORM\Column(type="boolean", options={"unsigned":true, "default":"0"})
     */
    protected $is_active = false;

    /**
     * @ORM\Column(type="boolean", options={"unsigned":true, "default":"0"})
     */
    protected $is_locked = false;

    /**
     * @ORM\Column(type="boolean", options={"unsigned":true, "default":"1"})
     */
    protected $is_public = true;

    /**
     * @ORM\Column(type="integer", options={"default":"0"})
     */
    protected $points = 0;

    /**
     * @ORM\ManyToOne(targetEntity="UserAudit", inversedBy="users")
     * @ORM\JoinColumn(name="id", referencedColumnName="audited_user_id", nullable=false)
     */
    protected $userAudit;

    /**
     * @ORM\ManyToOne(targetEntity="UserProfile", inversedBy="users")
     * @ORM\JoinColumn(name="id", referencedColumnName="user_id", nullable=false, onDelete="CASCADE")
     */
    protected $userProfile;

    /**
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="users")
     * @ORM\JoinColumn(name="id", referencedColumnName="author_id", nullable=false)
     */
    protected $page;

    /**
     * @ORM\ManyToOne(targetEntity="UserPointLog", inversedBy="users")
     * @ORM\JoinColumn(name="id", referencedColumnName="user_id", nullable=false)
     */
    protected $userPointLog;

    /**
     * @ORM\ManyToOne(targetEntity="PagePointLog", inversedBy="users")
     * @ORM\JoinColumn(name="id", referencedColumnName="user_id", nullable=false)
     */
    protected $pagePointLog;

    /**
     * @ORM\ManyToOne(targetEntity="UserBadge", inversedBy="users")
     * @ORM\JoinColumn(name="id", referencedColumnName="user_id", nullable=false)
     */
    protected $userBadge;

    public function __construct()
    {
    }

    public function __sleep()
    {
        return array('id', 'email', 'password', 'registered', 'last_session', 'session_ttl', 'is_admin', 'is_active', 'is_locked', 'is_public', 'points');
    }
}