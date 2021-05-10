<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510235136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fos_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles CLOB NOT NULL --(DC2Type:array)
        , created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, date_of_birth DATETIME DEFAULT NULL, firstname VARCHAR(64) DEFAULT NULL, lastname VARCHAR(64) DEFAULT NULL, website VARCHAR(64) DEFAULT NULL, biography VARCHAR(1000) DEFAULT NULL, gender VARCHAR(1) DEFAULT NULL, locale VARCHAR(8) DEFAULT NULL, timezone VARCHAR(64) DEFAULT NULL, phone VARCHAR(64) DEFAULT NULL, facebook_uid VARCHAR(255) DEFAULT NULL, facebook_name VARCHAR(255) DEFAULT NULL, facebook_data CLOB DEFAULT NULL --(DC2Type:json)
        , twitter_uid VARCHAR(255) DEFAULT NULL, twitter_name VARCHAR(255) DEFAULT NULL, twitter_data CLOB DEFAULT NULL --(DC2Type:json)
        , gplus_uid VARCHAR(255) DEFAULT NULL, gplus_name VARCHAR(255) DEFAULT NULL, gplus_data CLOB DEFAULT NULL --(DC2Type:json)
        , token VARCHAR(255) DEFAULT NULL, two_step_code VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A647992FC23A8 ON fos_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479A0D96FBF ON fos_user (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479C05FB297 ON fos_user (confirmation_token)');
        $this->addSql('CREATE TABLE fos_user_user_group (user_id INTEGER NOT NULL, group_id INTEGER NOT NULL, PRIMARY KEY(user_id, group_id))');
        $this->addSql('CREATE INDEX IDX_B3C77447A76ED395 ON fos_user_user_group (user_id)');
        $this->addSql('CREATE INDEX IDX_B3C77447FE54D947 ON fos_user_user_group (group_id)');
        $this->addSql('CREATE TABLE fos_user_group (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:array)
        )');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_583D1F3E5E237E06 ON fos_user_group (name)');
        $this->addSql('DROP INDEX IDX_268B9C9DFC3FF006');
        $this->addSql('DROP INDEX IDX_268B9C9D9D12EF95');
        $this->addSql('CREATE TEMPORARY TABLE __temp__agent AS SELECT id, representative_id, celebrity_id, territory FROM agent');
        $this->addSql('DROP TABLE agent');
        $this->addSql('CREATE TABLE agent (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, representative_id INTEGER NOT NULL, celebrity_id INTEGER NOT NULL, territory VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_268B9C9DFC3FF006 FOREIGN KEY (representative_id) REFERENCES representative (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_268B9C9D9D12EF95 FOREIGN KEY (celebrity_id) REFERENCES celebrity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO agent (id, representative_id, celebrity_id, territory) SELECT id, representative_id, celebrity_id, territory FROM __temp__agent');
        $this->addSql('DROP TABLE __temp__agent');
        $this->addSql('CREATE INDEX IDX_268B9C9DFC3FF006 ON agent (representative_id)');
        $this->addSql('CREATE INDEX IDX_268B9C9D9D12EF95 ON agent (celebrity_id)');
        $this->addSql('DROP INDEX IDX_FA2425B9FC3FF006');
        $this->addSql('DROP INDEX IDX_FA2425B99D12EF95');
        $this->addSql('CREATE TEMPORARY TABLE __temp__manager AS SELECT id, representative_id, celebrity_id, territory FROM manager');
        $this->addSql('DROP TABLE manager');
        $this->addSql('CREATE TABLE manager (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, representative_id INTEGER NOT NULL, celebrity_id INTEGER NOT NULL, territory VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_FA2425B9FC3FF006 FOREIGN KEY (representative_id) REFERENCES representative (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FA2425B99D12EF95 FOREIGN KEY (celebrity_id) REFERENCES celebrity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO manager (id, representative_id, celebrity_id, territory) SELECT id, representative_id, celebrity_id, territory FROM __temp__manager');
        $this->addSql('DROP TABLE __temp__manager');
        $this->addSql('CREATE INDEX IDX_FA2425B9FC3FF006 ON manager (representative_id)');
        $this->addSql('CREATE INDEX IDX_FA2425B99D12EF95 ON manager (celebrity_id)');
        $this->addSql('DROP INDEX IDX_38C8F80CFC3FF006');
        $this->addSql('DROP INDEX IDX_38C8F80C9D12EF95');
        $this->addSql('CREATE TEMPORARY TABLE __temp__publicist AS SELECT id, representative_id, celebrity_id, territory FROM publicist');
        $this->addSql('DROP TABLE publicist');
        $this->addSql('CREATE TABLE publicist (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, representative_id INTEGER NOT NULL, celebrity_id INTEGER NOT NULL, territory VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_38C8F80CFC3FF006 FOREIGN KEY (representative_id) REFERENCES representative (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_38C8F80C9D12EF95 FOREIGN KEY (celebrity_id) REFERENCES celebrity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO publicist (id, representative_id, celebrity_id, territory) SELECT id, representative_id, celebrity_id, territory FROM __temp__publicist');
        $this->addSql('DROP TABLE __temp__publicist');
        $this->addSql('CREATE INDEX IDX_38C8F80CFC3FF006 ON publicist (representative_id)');
        $this->addSql('CREATE INDEX IDX_38C8F80C9D12EF95 ON publicist (celebrity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE fos_user_user_group');
        $this->addSql('DROP TABLE fos_user_group');
        $this->addSql('DROP INDEX IDX_268B9C9DFC3FF006');
        $this->addSql('DROP INDEX IDX_268B9C9D9D12EF95');
        $this->addSql('CREATE TEMPORARY TABLE __temp__agent AS SELECT id, representative_id, celebrity_id, territory FROM agent');
        $this->addSql('DROP TABLE agent');
        $this->addSql('CREATE TABLE agent (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, representative_id INTEGER NOT NULL, celebrity_id INTEGER NOT NULL, territory VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO agent (id, representative_id, celebrity_id, territory) SELECT id, representative_id, celebrity_id, territory FROM __temp__agent');
        $this->addSql('DROP TABLE __temp__agent');
        $this->addSql('CREATE INDEX IDX_268B9C9DFC3FF006 ON agent (representative_id)');
        $this->addSql('CREATE INDEX IDX_268B9C9D9D12EF95 ON agent (celebrity_id)');
        $this->addSql('DROP INDEX IDX_FA2425B9FC3FF006');
        $this->addSql('DROP INDEX IDX_FA2425B99D12EF95');
        $this->addSql('CREATE TEMPORARY TABLE __temp__manager AS SELECT id, representative_id, celebrity_id, territory FROM manager');
        $this->addSql('DROP TABLE manager');
        $this->addSql('CREATE TABLE manager (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, representative_id INTEGER NOT NULL, celebrity_id INTEGER NOT NULL, territory VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO manager (id, representative_id, celebrity_id, territory) SELECT id, representative_id, celebrity_id, territory FROM __temp__manager');
        $this->addSql('DROP TABLE __temp__manager');
        $this->addSql('CREATE INDEX IDX_FA2425B9FC3FF006 ON manager (representative_id)');
        $this->addSql('CREATE INDEX IDX_FA2425B99D12EF95 ON manager (celebrity_id)');
        $this->addSql('DROP INDEX IDX_38C8F80CFC3FF006');
        $this->addSql('DROP INDEX IDX_38C8F80C9D12EF95');
        $this->addSql('CREATE TEMPORARY TABLE __temp__publicist AS SELECT id, representative_id, celebrity_id, territory FROM publicist');
        $this->addSql('DROP TABLE publicist');
        $this->addSql('CREATE TABLE publicist (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, representative_id INTEGER NOT NULL, celebrity_id INTEGER NOT NULL, territory VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO publicist (id, representative_id, celebrity_id, territory) SELECT id, representative_id, celebrity_id, territory FROM __temp__publicist');
        $this->addSql('DROP TABLE __temp__publicist');
        $this->addSql('CREATE INDEX IDX_38C8F80CFC3FF006 ON publicist (representative_id)');
        $this->addSql('CREATE INDEX IDX_38C8F80C9D12EF95 ON publicist (celebrity_id)');
    }
}
