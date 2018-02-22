<?php

namespace XframeCMS\Model\Db;

use Doctrine\ORM\Mapping as ORM;

/**
 * XframeCMS\Model\Db\TmpUser
 *
 * @ORM\Entity(repositoryClass="XframeCMS\Repository\TmpUserRepository")
 * @ORM\Table(name="tmp_user")
 */
class TmpUser extends \XframeCMS\Model\AbstractModel
{
    /**
     * @ORM\Id
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
    protected $created;

    public function __construct()
    {
        $this->created = new \DateTime('now');
    }

    public function __sleep()
    {
        return array('email', 'token', 'created');
    }
}