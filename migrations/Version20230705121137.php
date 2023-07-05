<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230705121137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car_image DROP FOREIGN KEY FK_1A968188A0EF1B80');
        $this->addSql('DROP INDEX IDX_1A968188A0EF1B80 ON car_image');
        $this->addSql('ALTER TABLE car_image CHANGE car_id_id car_id INT NOT NULL');
        $this->addSql('ALTER TABLE car_image ADD CONSTRAINT FK_1A968188C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_1A968188C3C6F69F ON car_image (car_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car_image DROP FOREIGN KEY FK_1A968188C3C6F69F');
        $this->addSql('DROP INDEX IDX_1A968188C3C6F69F ON car_image');
        $this->addSql('ALTER TABLE car_image CHANGE car_id car_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE car_image ADD CONSTRAINT FK_1A968188A0EF1B80 FOREIGN KEY (car_id_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_1A968188A0EF1B80 ON car_image (car_id_id)');
    }
}
