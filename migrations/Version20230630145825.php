<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230630145825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car CHANGE description description VARCHAR(800) DEFAULT NULL');
        $this->addSql('ALTER TABLE comment CHANGE message message VARCHAR(600) NOT NULL');
        $this->addSql('ALTER TABLE service CHANGE description description VARCHAR(1000) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car CHANGE description description VARCHAR(300) DEFAULT NULL');
        $this->addSql('ALTER TABLE comment CHANGE message message VARCHAR(300) NOT NULL');
        $this->addSql('ALTER TABLE service CHANGE description description VARCHAR(500) NOT NULL');
    }
}
