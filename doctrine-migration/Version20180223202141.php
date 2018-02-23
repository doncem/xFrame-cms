<?php declare(strict_types = 1);

namespace Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180223202141 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE x_page_update_log (id INT UNSIGNED AUTO_INCREMENT NOT NULL, page_id INT UNSIGNED NOT NULL, author_id INT UNSIGNED NOT NULL, updated DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, diff JSON NOT NULL, INDEX page_update_log_author_id (author_id), INDEX page_update_log_page_id (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_user_profile (user_id INT UNSIGNED NOT NULL, nickname VARCHAR(100) DEFAULT NULL, about LONGTEXT DEFAULT NULL, profile_pic VARCHAR(255) DEFAULT NULL, signature VARCHAR(255) DEFAULT NULL, PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_menu (id INT UNSIGNED AUTO_INCREMENT NOT NULL, page_id INT UNSIGNED NOT NULL, `name` VARCHAR(50) NOT NULL, view_order SMALLINT UNSIGNED NOT NULL, parent_id INT UNSIGNED DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\' NOT NULL, UNIQUE INDEX UNIQ_B0B1939AC4663E4 (page_id), INDEX menu_page_id (page_id), INDEX menu_parent_id (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_user (id INT UNSIGNED AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, `password` VARCHAR(72) DEFAULT NULL, registered DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, last_session VARCHAR(44) NOT NULL, session_ttl SMALLINT UNSIGNED DEFAULT 30 NOT NULL, is_admin TINYINT(1) DEFAULT \'0\' NOT NULL, is_active TINYINT(1) DEFAULT \'0\' NOT NULL, is_locked TINYINT(1) DEFAULT \'0\' NOT NULL, is_public TINYINT(1) DEFAULT \'1\' NOT NULL, points INT DEFAULT 0 NOT NULL, UNIQUE INDEX user_email (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_page (id INT UNSIGNED AUTO_INCREMENT NOT NULL, author_id INT UNSIGNED NOT NULL, url_param VARCHAR(100) NOT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, is_published TINYINT(1) DEFAULT \'0\' NOT NULL, controller VARCHAR(50) NOT NULL, total_points INT DEFAULT 0 NOT NULL, INDEX page_author_id (author_id), UNIQUE INDEX url_param_UNIQUE (url_param), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_user_badge (id INT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, badge_id INT UNSIGNED NOT NULL, earned DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX user_badge_user (user_id), INDEX user_badge (badge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_user_point_log (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, point_id INT UNSIGNED NOT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX user_point (point_id), INDEX user_point_user (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_user_audit (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, audited_user_id INT UNSIGNED NOT NULL, action_id SMALLINT UNSIGNED NOT NULL, `data` LONGTEXT DEFAULT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, user_id INT UNSIGNED NOT NULL, INDEX user_audit_action (action_id), INDEX user_audit_user (audited_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE xtmp_user (email VARCHAR(100) NOT NULL, token VARCHAR(36) NOT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(email)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE x_page_point_log (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, page_id INT UNSIGNED NOT NULL, point SMALLINT NOT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX page_point_user (user_id), INDEX page_point_page (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE x_page_update_log ADD CONSTRAINT FK_8993F8D1C4663E4 FOREIGN KEY (page_id) REFERENCES x_page (id)');
        $this->addSql('ALTER TABLE x_page_update_log ADD CONSTRAINT FK_8993F8D1F675F31B FOREIGN KEY (author_id) REFERENCES x_user (id)');
        $this->addSql('ALTER TABLE x_user_profile ADD CONSTRAINT FK_84F8449AA76ED395 FOREIGN KEY (user_id) REFERENCES x_user (id)');
        $this->addSql('ALTER TABLE x_menu ADD CONSTRAINT FK_B0B1939ABF396750 FOREIGN KEY (id) REFERENCES x_menu (parent_id)');
        $this->addSql('ALTER TABLE x_menu ADD CONSTRAINT FK_B0B1939AC4663E4 FOREIGN KEY (page_id) REFERENCES x_page (id)');
        $this->addSql('ALTER TABLE x_page ADD CONSTRAINT FK_D9BE1F29F675F31B FOREIGN KEY (author_id) REFERENCES x_user (id)');
        $this->addSql('ALTER TABLE x_user_badge ADD CONSTRAINT FK_4D6DC3B4A76ED395 FOREIGN KEY (user_id) REFERENCES x_user (id)');
        $this->addSql('ALTER TABLE x_user_point_log ADD CONSTRAINT FK_97775ED3A76ED395 FOREIGN KEY (user_id) REFERENCES x_user (id)');
        $this->addSql('ALTER TABLE x_user_audit ADD CONSTRAINT FK_218574D0F7D575F9 FOREIGN KEY (audited_user_id) REFERENCES x_user (id)');
        $this->addSql('ALTER TABLE x_page_point_log ADD CONSTRAINT FK_AC796CF8A76ED395 FOREIGN KEY (user_id) REFERENCES x_user (id)');
        $this->addSql('ALTER TABLE x_page_point_log ADD CONSTRAINT FK_AC796CF8C4663E4 FOREIGN KEY (page_id) REFERENCES x_page (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE x_menu DROP FOREIGN KEY FK_B0B1939ABF396750');
        $this->addSql('ALTER TABLE x_page_update_log DROP FOREIGN KEY FK_8993F8D1F675F31B');
        $this->addSql('ALTER TABLE x_user_profile DROP FOREIGN KEY FK_84F8449AA76ED395');
        $this->addSql('ALTER TABLE x_page DROP FOREIGN KEY FK_D9BE1F29F675F31B');
        $this->addSql('ALTER TABLE x_user_badge DROP FOREIGN KEY FK_4D6DC3B4A76ED395');
        $this->addSql('ALTER TABLE x_user_point_log DROP FOREIGN KEY FK_97775ED3A76ED395');
        $this->addSql('ALTER TABLE x_user_audit DROP FOREIGN KEY FK_218574D0F7D575F9');
        $this->addSql('ALTER TABLE x_page_point_log DROP FOREIGN KEY FK_AC796CF8A76ED395');
        $this->addSql('ALTER TABLE x_page_update_log DROP FOREIGN KEY FK_8993F8D1C4663E4');
        $this->addSql('ALTER TABLE x_menu DROP FOREIGN KEY FK_B0B1939AC4663E4');
        $this->addSql('ALTER TABLE x_page_point_log DROP FOREIGN KEY FK_AC796CF8C4663E4');
        $this->addSql('DROP TABLE x_page_update_log');
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
