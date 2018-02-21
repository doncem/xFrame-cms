<?php

namespace XframeCMS\Model\Db;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\OneToMany(targetEntity="Page", mappedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="author_id", nullable=false)
     */
    protected $pages;

    /**
     * @ORM\OneToMany(targetEntity="PagePointLog", mappedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="user_id", nullable=false)
     */
    protected $pagePointLogs;

    /**
     * @ORM\OneToMany(targetEntity="PageUpdateLog", mappedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="author_id", nullable=false)
     */
    protected $pageUpdateLogs;

    /**
     * @ORM\OneToMany(targetEntity="UserAudit", mappedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="audited_user_id", nullable=false)
     */
    protected $userAudits;

    /**
     * @ORM\OneToMany(targetEntity="UserBadge", mappedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="user_id", nullable=false)
     */
    protected $userBadges;

    /**
     * @ORM\OneToMany(targetEntity="UserPointLog", mappedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="user_id", nullable=false)
     */
    protected $userPointLogs;

    /**
     * @ORM\OneToOne(targetEntity="UserProfile", mappedBy="user")
     */
    protected $userProfile;

    public function __construct()
    {
        $this->pages = new ArrayCollection();
        $this->pagePointLogs = new ArrayCollection();
        $this->pageUpdateLogs = new ArrayCollection();
        $this->userAudits = new ArrayCollection();
        $this->userBadges = new ArrayCollection();
        $this->userPointLogs = new ArrayCollection();
        $this->userProfiles = new ArrayCollection();
    }

    public function __sleep()
    {
        return array('id', 'email', 'password', 'registered', 'last_session', 'session_ttl', 'is_admin', 'is_active', 'is_locked', 'is_public', 'points');
    }
}