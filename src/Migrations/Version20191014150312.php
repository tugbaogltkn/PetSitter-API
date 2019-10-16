<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191014150312 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE owner ADD phone VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sitter ADD name VARCHAR(255) NOT NULL, ADD username VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD phone VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD address VARCHAR(255) NOT NULL, ADD country VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD state VARCHAR(255) NOT NULL, ADD county VARCHAR(255) NOT NULL, ADD post_code VARCHAR(255) NOT NULL, ADD is_verified TINYINT(1) DEFAULT \'0\' NOT NULL COMMENT \'Describes user is verified by email\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE owner DROP phone');
        $this->addSql('ALTER TABLE sitter DROP name, DROP username, DROP email, DROP phone, DROP password, DROP address, DROP country, DROP city, DROP state, DROP county, DROP post_code, DROP is_verified');
    }
}
