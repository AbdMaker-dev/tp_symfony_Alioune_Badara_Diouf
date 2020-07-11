<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200709124012 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chambres (id INT AUTO_INCREMENT NOT NULL, num_chambre VARCHAR(15) NOT NULL, num_batiment VARCHAR(15) NOT NULL, type INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiants (id INT AUTO_INCREMENT NOT NULL, chambre_id INT DEFAULT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(50) NOT NULL, adresse VARCHAR(50) DEFAULT NULL, tel VARCHAR(10) NOT NULL, email VARCHAR(50) NOT NULL, nee_at DATETIME NOT NULL, INDEX IDX_227C02EB9B177F54 (chambre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etudiants ADD CONSTRAINT FK_227C02EB9B177F54 FOREIGN KEY (chambre_id) REFERENCES chambres (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiants DROP FOREIGN KEY FK_227C02EB9B177F54');
        $this->addSql('DROP TABLE chambres');
        $this->addSql('DROP TABLE etudiants');
    }
}
