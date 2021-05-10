<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510170245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agent (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, representative_id INTEGER NOT NULL, territory VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_268B9C9DFC3FF006 ON agent (representative_id)');
        $this->addSql('CREATE TABLE celebrity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, birthday DATE NOT NULL --(DC2Type:date_immutable)
        , bio CLOB NOT NULL)');
        $this->addSql('CREATE TABLE manager (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, representative_id INTEGER NOT NULL, territory VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_FA2425B9FC3FF006 ON manager (representative_id)');
        $this->addSql('CREATE TABLE publicist (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, representative_id INTEGER NOT NULL, territory VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_38C8F80CFC3FF006 ON publicist (representative_id)');
        $this->addSql('CREATE TABLE representative (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, emails CLOB NOT NULL --(DC2Type:simple_array)
        )');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE celebrity');
        $this->addSql('DROP TABLE manager');
        $this->addSql('DROP TABLE publicist');
        $this->addSql('DROP TABLE representative');
    }
}
