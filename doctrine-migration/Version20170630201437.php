<?php

namespace Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170630201437 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE x_menu (id INT UNSIGNED AUTO_INCREMENT NOT NULL, page_id INT UNSIGNED NOT NULL, name VARCHAR(50) NOT NULL COLLATE utf8_lithuanian_ci, view_order TINYINT(1) NOT NULL, parent_id INT UNSIGNED DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\' NOT NULL, INDEX menu_page_id (page_id), INDEX menu_parent_id (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_page (id INT UNSIGNED AUTO_INCREMENT NOT NULL, url_param VARCHAR(100) NOT NULL COLLATE utf8_lithuanian_ci, author_id INT UNSIGNED NOT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated DATETIME DEFAULT NULL, is_published TINYINT(1) DEFAULT \'0\' NOT NULL, controller VARCHAR(50) NOT NULL COLLATE utf8_lithuanian_ci, point INT DEFAULT 0 NOT NULL, UNIQUE INDEX url_param_UNIQUE (url_param), INDEX page_author_id (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_page_point_log (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, page_id INT UNSIGNED NOT NULL, point_id INT UNSIGNED NOT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX page_point (point_id), INDEX page_point_user (user_id), INDEX page_point_page (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_user (id INT UNSIGNED AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL COLLATE utf8_general_ci, password VARCHAR(72) DEFAULT NULL COLLATE utf8_general_ci, registered DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, last_session VARCHAR(44) NOT NULL COLLATE utf8_general_ci, session_ttl SMALLINT UNSIGNED DEFAULT 30 NOT NULL COMMENT \'time to live in minutes\', is_admin TINYINT(1) DEFAULT \'0\' NOT NULL, is_active TINYINT(1) DEFAULT \'0\' NOT NULL, is_locked TINYINT(1) DEFAULT \'0\' NOT NULL, is_public TINYINT(1) DEFAULT \'1\' NOT NULL, points INT DEFAULT 0 NOT NULL, UNIQUE INDEX user_email (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_user_audit (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, audited_user_id INT UNSIGNED NOT NULL, action_id SMALLINT UNSIGNED NOT NULL, data TEXT DEFAULT NULL COLLATE utf8_lithuanian_ci, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, user_id INT UNSIGNED NOT NULL, INDEX user_audit_action (action_id), INDEX user_audit_user (audited_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_user_badge (id INT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, badge_id INT UNSIGNED NOT NULL, earned DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX user_badge_user (user_id), INDEX user_badge (badge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_user_point_log (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, point_id INT UNSIGNED NOT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX user_point (point_id), INDEX user_point_user (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_user_profile (user_id INT UNSIGNED NOT NULL, nickname VARCHAR(100) DEFAULT NULL COLLATE utf8_general_ci, about TEXT DEFAULT NULL COLLATE utf8_general_ci, profile_pic VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, signature VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, UNIQUE INDEX user_profile_user_id (user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE xtmp_user (email VARCHAR(100) NOT NULL COLLATE utf8_general_ci, token VARCHAR(36) NOT NULL COLLATE utf8_general_ci, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX tmp_email (email)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE x_menu ADD CONSTRAINT fk_menu_parent_id FOREIGN KEY (id) REFERENCES x_menu (parent_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE x_page ADD CONSTRAINT fk_page_menu FOREIGN KEY (id) REFERENCES x_menu (page_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE x_page ADD CONSTRAINT fk_page_point_log FOREIGN KEY (id) REFERENCES x_page_point_log (page_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE x_user ADD CONSTRAINT fk_user_audit FOREIGN KEY (id) REFERENCES x_user_audit (audited_user_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE x_user ADD CONSTRAINT fk_user_badge FOREIGN KEY (id) REFERENCES x_user_badge (user_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE x_user ADD CONSTRAINT fk_user_page FOREIGN KEY (id) REFERENCES x_page (author_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE x_user ADD CONSTRAINT fk_user_page_point_log FOREIGN KEY (id) REFERENCES x_page_point_log (user_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE x_user ADD CONSTRAINT fk_user_point_log FOREIGN KEY (id) REFERENCES x_user_point_log (user_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE x_user ADD CONSTRAINT fk_user_profile FOREIGN KEY (id) REFERENCES x_user_profile (user_id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE x_menu DROP FOREIGN KEY fk_menu_parent_id');
        $this->addSql('ALTER TABLE x_page DROP FOREIGN KEY fk_page_menu');
        $this->addSql('ALTER TABLE x_user DROP FOREIGN KEY fk_user_page');
        $this->addSql('ALTER TABLE x_page DROP FOREIGN KEY fk_page_point_log');
        $this->addSql('ALTER TABLE x_user DROP FOREIGN KEY fk_user_page_point_log');
        $this->addSql('ALTER TABLE x_user DROP FOREIGN KEY fk_user_audit');
        $this->addSql('ALTER TABLE x_user DROP FOREIGN KEY fk_user_badge');
        $this->addSql('ALTER TABLE x_user DROP FOREIGN KEY fk_user_point_log');
        $this->addSql('ALTER TABLE x_user DROP FOREIGN KEY fk_user_profile');
        $this->addSql('DROP TABLE x_menu');
        $this->addSql('DROP TABLE x_page');
        $this->addSql('DROP TABLE x_page_point_log');
        $this->addSql('DROP TABLE x_user');
        $this->addSql('DROP TABLE x_user_audit');
        $this->addSql('DROP TABLE x_user_badge');
        $this->addSql('DROP TABLE x_user_point_log');
        $this->addSql('DROP TABLE x_user_profile');
        $this->addSql('DROP TABLE xtmp_user');
    }
}
