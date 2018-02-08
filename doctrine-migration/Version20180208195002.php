<?php declare(strict_types = 1);

namespace Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180208195002 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE x_user_profile (user_id INT UNSIGNED NOT NULL, nickname VARCHAR(100) DEFAULT \'NULL\', about LONGTEXT DEFAULT NULL, profile_pic VARCHAR(255) DEFAULT \'NULL\', signature VARCHAR(255) DEFAULT \'NULL\', PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_menu (id INT UNSIGNED AUTO_INCREMENT NOT NULL, page_id INT UNSIGNED NOT NULL, `name` VARCHAR(50) NOT NULL, view_order SMALLINT UNSIGNED NOT NULL, parent_id INT UNSIGNED DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\' NOT NULL, INDEX menu_page_id (page_id), INDEX menu_parent_id (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_user (id INT UNSIGNED AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, `password` VARCHAR(72) DEFAULT \'NULL\', registered DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, last_session VARCHAR(44) NOT NULL, session_ttl SMALLINT UNSIGNED DEFAULT 30 NOT NULL, is_admin TINYINT(1) DEFAULT \'0\' NOT NULL, is_active TINYINT(1) DEFAULT \'0\' NOT NULL, is_locked TINYINT(1) DEFAULT \'0\' NOT NULL, is_public TINYINT(1) DEFAULT \'1\' NOT NULL, points INT DEFAULT 0 NOT NULL, UNIQUE INDEX user_email (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_page (id INT UNSIGNED AUTO_INCREMENT NOT NULL, url_param VARCHAR(100) NOT NULL, author_id INT UNSIGNED NOT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated DATETIME DEFAULT NULL, is_published TINYINT(1) DEFAULT \'0\' NOT NULL, controller VARCHAR(50) NOT NULL, total_points INT DEFAULT 0 NOT NULL, INDEX page_author_id (author_id), UNIQUE INDEX url_param_UNIQUE (url_param), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_user_badge (id INT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, badge_id INT UNSIGNED NOT NULL, earned DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX user_badge_user (user_id), INDEX user_badge (badge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_user_point_log (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, point_id INT UNSIGNED NOT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX user_point (point_id), INDEX user_point_user (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_user_audit (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, audited_user_id INT UNSIGNED NOT NULL, action_id SMALLINT UNSIGNED NOT NULL, `data` LONGTEXT DEFAULT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, user_id INT UNSIGNED NOT NULL, INDEX user_audit_action (action_id), INDEX user_audit_user (audited_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE xtmp_user (email VARCHAR(100) NOT NULL, token VARCHAR(36) NOT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(email)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_page_point_log (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, page_id INT UNSIGNED NOT NULL, point SMALLINT NOT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX page_point_user (user_id), INDEX page_point_page (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE x_menu ADD CONSTRAINT FK_B0B1939ABF396750 FOREIGN KEY (id) REFERENCES x_menu (parent_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE x_menu DROP FOREIGN KEY FK_B0B1939ABF396750');
        $this->addSql('DROP TABLE x_user_profile');
        $this->addSql('DROP TABLE x_menu');
        $this->addSql('DROP TABLE x_user');
        $this->addSql('DROP TABLE x_page');
        $this->addSql('DROP TABLE x_user_badge');
        $this->addSql('DROP TABLE x_user_point_log');
        $this->addSql('DROP TABLE x_user_audit');
        $this->addSql('DROP TABLE xtmp_user');
        $this->addSql('DROP TABLE x_page_point_log');
    }
}
