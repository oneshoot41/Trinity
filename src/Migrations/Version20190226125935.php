<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190226125935 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE expositions_oeuvres (expositions_id INT NOT NULL, oeuvres_id INT NOT NULL, INDEX IDX_ED4C39533AF42CAB (expositions_id), INDEX IDX_ED4C39534928CE22 (oeuvres_id), PRIMARY KEY(expositions_id, oeuvres_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE expositions_oeuvres ADD CONSTRAINT FK_ED4C39533AF42CAB FOREIGN KEY (expositions_id) REFERENCES expositions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE expositions_oeuvres ADD CONSTRAINT FK_ED4C39534928CE22 FOREIGN KEY (oeuvres_id) REFERENCES oeuvres (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE expositions_oeuvres');
    }
}
