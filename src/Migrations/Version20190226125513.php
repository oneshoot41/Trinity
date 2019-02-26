<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190226125513 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE oeuvres_expositions');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE oeuvres_expositions (oeuvres_id INT NOT NULL, expositions_id INT NOT NULL, INDEX IDX_F639C5A23AF42CAB (expositions_id), INDEX IDX_F639C5A24928CE22 (oeuvres_id), PRIMARY KEY(oeuvres_id, expositions_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE oeuvres_expositions ADD CONSTRAINT FK_F639C5A23AF42CAB FOREIGN KEY (expositions_id) REFERENCES expositions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvres_expositions ADD CONSTRAINT FK_F639C5A24928CE22 FOREIGN KEY (oeuvres_id) REFERENCES oeuvres (id) ON DELETE CASCADE');
    }
}
