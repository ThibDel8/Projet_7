<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523082422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product CHANGE price price DOUBLE PRECISION DEFAULT NULL, CHANGE color color VARCHAR(50) DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE specification CHANGE weight weight INT DEFAULT NULL, CHANGE resolution resolution VARCHAR(20) DEFAULT NULL, CHANGE processor processor VARCHAR(50) DEFAULT NULL, CHANGE ram ram VARCHAR(4) DEFAULT NULL, CHANGE storage storage VARCHAR(5) DEFAULT NULL, CHANGE battery battery VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE phone_number phone_number VARCHAR(25) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE specification CHANGE weight weight INT NOT NULL, CHANGE resolution resolution VARCHAR(20) NOT NULL, CHANGE processor processor VARCHAR(50) NOT NULL, CHANGE ram ram VARCHAR(4) NOT NULL, CHANGE storage storage VARCHAR(5) NOT NULL, CHANGE battery battery VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE phone_number phone_number VARCHAR(25) NOT NULL');
        $this->addSql('ALTER TABLE product CHANGE price price DOUBLE PRECISION NOT NULL, CHANGE color color VARCHAR(50) NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE image image VARCHAR(255) NOT NULL');
    }
}
