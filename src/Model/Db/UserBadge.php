<?php

namespace XframeCMS\Model\Db;

use Doctrine\ORM\Mapping as ORM;

/**
 * XframeCMS\Model\Db\UserBadge
 *
 * @ORM\Entity(repositoryClass="XframeCMS\Repository\UserBadgeRepository")
 * @ORM\Table(name="_user_badge", indexes={@ORM\Index(name="user_badge_user", columns={"user_id"}), @ORM\Index(name="user_badge", columns={"badge_id"})})
 */
class UserBadge extends \XframeCMS\Model\AbstractModel
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
    protected $user_id;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    protected $badge_id;

    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    protected $earned = CURRENT_TIMESTAMP;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userBadges")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;

    public function __construct()
    {
    }

    public function __sleep()
    {
        return array('id', 'user_id', 'badge_id', 'earned');
    }
}