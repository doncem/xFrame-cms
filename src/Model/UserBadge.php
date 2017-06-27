<?php

namespace XframeCMS\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * XframeCMS\Model\UserBadge
 *
 * @ORM\Entity(repositoryClass="UserBadgeRepository")
 * @ORM\Table(name="_user_badge", indexes={@ORM\Index(name="user_badge_user", columns={"user_id"}), @ORM\Index(name="user_badge", columns={"badge_id"})})
 */
class UserBadge extends \XframeCMS\AbstractModel
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
     * @ORM\Column(type="datetime")
     */
    protected $earned;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="userBadge")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function __sleep()
    {
        return array('id', 'user_id', 'badge_id', 'earned');
    }
}