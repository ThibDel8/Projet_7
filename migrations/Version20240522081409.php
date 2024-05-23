<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522081409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, street VARCHAR(255) NOT NULL, city VARCHAR(100) NOT NULL, zip_code VARCHAR(10) NOT NULL, country VARCHAR(100) NOT NULL, INDEX IDX_D4E6F81A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, specs_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, brand VARCHAR(50) NOT NULL, model VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, color VARCHAR(50) NOT NULL, stock TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D34A04ADCDB41915 (specs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specification (id INT AUTO_INCREMENT NOT NULL, weight INT NOT NULL, resolution VARCHAR(20) NOT NULL, processor VARCHAR(50) NOT NULL, ram VARCHAR(4) NOT NULL, storage VARCHAR(5) NOT NULL, battery VARCHAR(10) NOT NULL, os VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, phone_number VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADCDB41915 FOREIGN KEY (specs_id) REFERENCES specification (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81A76ED395');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADCDB41915');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE specification');
        $this->addSql('DROP TABLE user');
    }
}
