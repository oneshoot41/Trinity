<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190209144832 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE anonymes (id INT AUTO_INCREMENT NOT NULL, exposition_id INT DEFAULT NULL, ordre VARCHAR(100) DEFAULT NULL, name LONGTEXT NOT NULL, INDEX IDX_FAF4345688ED476F (exposition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artistes (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, prenom VARCHAR(150) NOT NULL, biographie_fr LONGTEXT DEFAULT NULL, biographie_en LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expositions (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom VARCHAR(200) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, nb_vues INT DEFAULT NULL, description_fr LONGTEXT NOT NULL, description_en LONGTEXT NOT NULL, ordre VARCHAR(100) DEFAULT NULL, INDEX IDX_9F0CBF28A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oeuvres (id INT AUTO_INCREMENT NOT NULL, artiste_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, path LONGTEXT NOT NULL, livre TINYINT(1) NOT NULL, emplacement VARCHAR(255) DEFAULT NULL, description_fr LONGTEXT NOT NULL, description_en LONGTEXT NOT NULL, type VARCHAR(200) NOT NULL, INDEX IDX_413EEE3E21D25844 (artiste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oeuvres_expositions (oeuvres_id INT NOT NULL, expositions_id INT NOT NULL, INDEX IDX_F639C5A24928CE22 (oeuvres_id), INDEX IDX_F639C5A23AF42CAB (expositions_id), PRIMARY KEY(oeuvres_id, expositions_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', password VARCHAR(255) NOT NULL, nom VARCHAR(150) NOT NULL, prenom VARCHAR(150) NOT NULL, tel VARCHAR(10) DEFAULT NULL, service VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE anonymes ADD CONSTRAINT FK_FAF4345688ED476F FOREIGN KEY (exposition_id) REFERENCES expositions (id)');
        $this->addSql('ALTER TABLE expositions ADD CONSTRAINT FK_9F0CBF28A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE oeuvres ADD CONSTRAINT FK_413EEE3E21D25844 FOREIGN KEY (artiste_id) REFERENCES artistes (id)');
        $this->addSql('ALTER TABLE oeuvres_expositions ADD CONSTRAINT FK_F639C5A24928CE22 FOREIGN KEY (oeuvres_id) REFERENCES oeuvres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvres_expositions ADD CONSTRAINT FK_F639C5A23AF42CAB FOREIGN KEY (expositions_id) REFERENCES expositions (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE oeuvres DROP FOREIGN KEY FK_413EEE3E21D25844');
        $this->addSql('ALTER TABLE anonymes DROP FOREIGN KEY FK_FAF4345688ED476F');
        $this->addSql('ALTER TABLE oeuvres_expositions DROP FOREIGN KEY FK_F639C5A23AF42CAB');
        $this->addSql('ALTER TABLE oeuvres_expositions DROP FOREIGN KEY FK_F639C5A24928CE22');
        $this->addSql('ALTER TABLE expositions DROP FOREIGN KEY FK_9F0CBF28A76ED395');
        $this->addSql('DROP TABLE anonymes');
        $this->addSql('DROP TABLE artistes');
        $this->addSql('DROP TABLE expositions');
        $this->addSql('DROP TABLE oeuvres');
        $this->addSql('DROP TABLE oeuvres_expositions');
        $this->addSql('DROP TABLE users');
    }
}
