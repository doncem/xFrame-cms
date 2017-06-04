<?php

namespace XframeCMS\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * XframeCMS\Model\UserProfile
 *
 * @ORM\Entity(repositoryClass="UserProfileRepository")
 * @ORM\Table(name="_user_profile", uniqueConstraints={@ORM\UniqueConstraint(name="user_profile_user_id", columns={"user_id"})})
 */
class UserProfile extends XframeCMS\AbstractModel
{
    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    protected $user_id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $nickname;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $about;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $profile_pic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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