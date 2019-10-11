<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191007120537 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_district (user_id INT NOT NULL, district_id INT NOT NULL, INDEX IDX_D14CB087A76ED395 (user_id), INDEX IDX_D14CB087B08FA272 (district_id), PRIMARY KEY(user_id, district_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_district ADD CONSTRAINT FK_D14CB087A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_district ADD CONSTRAINT FK_D14CB087B08FA272 FOREIGN KEY (district_id) REFERENCES district (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD role VARCHAR(255) NOT NULL, ADD name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_district');
        $this->addSql('ALTER TABLE user DROP role, DROP name');
    }
}
