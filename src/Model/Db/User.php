<?php

namespace XframeCMS\Model\Db;

use Doctrine\ORM\Mapping as ORM;

/**
 * XframeCMS\Model\Db\User
 *
 * @ORM\Entity(repositoryClass="UserRepository")
 * @ORM\Table(name="_user", uniqueConstraints={@ORM\UniqueConstraint(name="user_email", columns={"email"})})
 */
class User extends \XframeCMS\Model\Db\AbstractModel
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
     * @ORM\Column(name="`password`", type="string", length=72, nullable=true)
     */
    protected $password;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $registered;

    /**
     * @ORM\Column(type="string", length=44)
     */
    protected $last_session;

    /**
     * time to live in minutes
     *
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $session_ttl;

    /**
     * @ORM\Column(type="boolean", options={"unsigned":true})
     */
    protected $is_admin;

    /**
     * @ORM\Column(type="boolean", options={"unsigned":true})
     */
    protected $is_active;

    /**
     * @ORM\Column(type="boolean", options={"unsigned":true})
     */
    protected $is_locked;

    /**
     * @ORM\Column(type="boolean", options={"unsigned":true})
     */
    protected $is_public;

    /**
     * @ORM\Column(type="integer")
     */
    protected $points;

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
