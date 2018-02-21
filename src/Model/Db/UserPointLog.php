<?php

namespace XframeCMS\Model\Db;

use Doctrine\ORM\Mapping as ORM;

/**
 * XframeCMS\Model\Db\UserPointLog
 *
 * @ORM\Entity(repositoryClass="XframeCMS\Repository\UserPointLogRepository")
 * @ORM\Table(name="_user_point_log", indexes={@ORM\Index(name="user_point", columns={"point_id"}), @ORM\Index(name="user_point_user", columns={"user_id"})})
 */
class UserPointLog extends \XframeCMS\Model\AbstractModel
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
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    protected $created = CURRENT_TIMESTAMP;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userPointLogs")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;

    public function __construct()
    {
    }

    public function __sleep()
    {
        return array('id', 'user_id', 'point_id', 'created');
    }
}