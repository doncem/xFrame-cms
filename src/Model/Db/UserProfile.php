<?php

namespace XframeCMS\Model\Db;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\Column(type="string", length=100, nullable=true, options={"default":"NULL"})
     */
    protected $nickname;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default":"NULL"})
     */
    protected $about;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"default":"NULL"})
     */
    protected $profile_pic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"default":"NULL"})
     */
    protected $signature;

    /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="userProfile")
     */
    protected $user;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function __sleep()
    {
        return array('user_id', 'nickname', 'about', 'profile_pic', 'signature');
    }
}