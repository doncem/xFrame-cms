<?php

namespace XframeCMS\Model\Db;

use Doctrine\ORM\Mapping as ORM;

/**
 * XframeCMS\Model\Db\TmpUser
 *
 * @ORM\Entity(repositoryClass="XframeCMS\Repository\TmpUserRepository")
 * @ORM\Table(name="tmp_user", uniqueConstraints={@ORM\UniqueConstraint(name="tmp_email", columns={"email"})})
 */
class TmpUser extends \XframeCMS\Model\Db\AbstractModel
{
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=36)
     */
    protected $token;

    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    protected $created = CURRENT_TIMESTAMP;

    public function __construct()
    {
    }

    public function __sleep()
    {
        return array('email', 'token', 'created');
    }
}