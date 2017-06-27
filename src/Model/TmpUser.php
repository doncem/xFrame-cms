<?php

namespace XframeCMS\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * XframeCMS\Model\TmpUser
 *
 * @ORM\Entity(repositoryClass="TmpUserRepository")
 * @ORM\Table(name="tmp_user", uniqueConstraints={@ORM\UniqueConstraint(name="tmp_email", columns={"email"})})
 */
class TmpUser extends \XframeCMS\AbstractModel
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
     * @ORM\Column(type="datetime")
     */
    protected $created;

    public function __construct()
    {
    }

    public function __sleep()
    {
        return array('email', 'token', 'created');
    }
}