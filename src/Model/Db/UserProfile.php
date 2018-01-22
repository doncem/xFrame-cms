<?php

namespace XframeCMS\Model\Db;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * XframeCMS\Model\Db\UserProfile
 *
 * @ORM\Entity(repositoryClass="XframeCMS\Repository\UserProfileRepository")
 * @ORM\Table(name="_user_profile", uniqueConstraints={@ORM\UniqueConstraint(name="user_profile_user_id", columns={"user_id"})})
 */
class UserProfile extends \XframeCMS\Model\AbstractModel
{
    /**
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
     * @ORM\OneToMany(targetEntity="User", mappedBy="userProfile")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function __sleep()
    {
        return array('user_id', 'nickname', 'about', 'profile_pic', 'signature');
    }
}