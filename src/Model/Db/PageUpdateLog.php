<?php

namespace XframeCMS\Model\Db;

use Doctrine\ORM\Mapping as ORM;

/**
 * XframeCMS\Model\Db\PageUpdateLog
 *
 * @ORM\Entity(repositoryClass="XframeCMS\Repository\PageUpdateLogRepository")
 * @ORM\Table(name="_page_update_log", indexes={@ORM\Index(name="page_update_log_author_id", columns={"author_id"}), @ORM\Index(name="page_update_log_page_id", columns={"page_id"})})
 */
class PageUpdateLog extends \XframeCMS\Model\AbstractModel
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
    protected $page_id;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    protected $author_id;

    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    protected $updated;

    /**
     * @ORM\Column(type="json", options={"jsonb":true})
     */
    protected $diff;

    /**
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="pageUpdateLogs")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id", nullable=false)
     */
    protected $page;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="pageUpdateLogs")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     */
    protected $user;

    public function __construct()
    {
        $this->updated = new \DateTime('now');
    }

    public function __sleep()
    {
        return array('id', 'page_id', 'author_id', 'updated', 'diff');
    }
}