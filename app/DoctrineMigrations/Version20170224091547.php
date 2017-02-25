<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170224091547 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

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
    }
}
