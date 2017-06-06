<?php

namespace XframeCMS\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * XframeCMS\Model\UserPointLog
 *
 * @ORM\Entity(repositoryClass="UserPointLogRepository")
 * @ORM\Table(name="_user_point_log", indexes={@ORM\Index(name="user_point", columns={"point_id"}), @ORM\Index(name="user_point_user", columns={"user_id"})})
 */
class UserPointLog extends XframeCMS\AbstractModel
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
    protected $user_id;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    protected $point_id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="userPointLog")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function __sleep()
    {
        return array('id', 'user_id', 'point_id', 'created');
    }
}