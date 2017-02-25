<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170224091105 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_F7129A80800A1141 ON user_user');
        $this->addSql('ALTER TABLE user_user ADD username_canonical VARCHAR(180) NOT NULL, ADD email VARCHAR(180) NOT NULL, ADD email_canonical VARCHAR(180) NOT NULL, ADD enabled TINYINT(1) NOT NULL, ADD salt VARCHAR(255) DEFAULT NULL, ADD password VARCHAR(255) NOT NULL, ADD last_login DATETIME DEFAULT NULL, ADD confirmation_token VARCHAR(180) DEFAULT NULL, ADD password_requested_at DATETIME DEFAULT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD user_api VARCHAR(100) NOT NULL, ADD facebook_id VARCHAR(255) DEFAULT NULL, CHANGE username username VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F7129A8092FC23A8 ON user_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F7129A80A0D96FBF ON user_user (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F7129A80C05FB297 ON user_user (confirmation_token)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_F7129A8092FC23A8 ON user_user');
        $this->addSql('DROP INDEX UNIQ_F7129A80A0D96FBF ON user_user');
        $this->addSql('DROP INDEX UNIQ_F7129A80C05FB297 ON user_user');
        $this->addSql('ALTER TABLE user_user DROP username_canonical, DROP email, DROP email_canonical, DROP enabled, DROP salt, DROP password, DROP last_login, DROP confirmation_token, DROP password_requested_at, DROP roles, DROP user_api, DROP facebook_id, CHANGE username username VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F7129A80800A1141 ON user_user (apiKey)');
    }
}
