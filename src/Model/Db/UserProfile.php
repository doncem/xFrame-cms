<?php

namespace XframeCMS\Model\Db;

use Doctrine\ORM\Mapping as ORM;

/**
 * XframeCMS\Model\Db\UserProfile
 *
 * @ORM\Entity(repositoryClass="XframeCMS\Repository\UserProfileRepository")
 * @ORM\Table(name="_user_profile")
 */
class UserProfile extends \XframeCMS\Model\AbstractModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    protected $user_id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true, options={})
     */
    protected $nickname;

    /**
     * @ORM\Column(type="text", nullable=true, options={})
     */
    protected $about;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={})
     */
    protected $profile_pic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={})
     */
    protected $signature;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="userProfile")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;

    public function __construct()
    {
    }

    public function __sleep()
    {
        return array('user_id', 'nickname', 'about', 'profile_pic', 'signature');
    }
}