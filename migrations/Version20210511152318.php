<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511152318 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_268B9C9D9D12EF95');
        $this->addSql('DROP INDEX IDX_268B9C9DFC3FF006');
        $this->addSql('CREATE TEMPORARY TABLE __temp__agent AS SELECT id, representative_id, celebrity_id, territory FROM agent');
        $this->addSql('DROP TABLE agent');
        $this->addSql('CREATE TABLE agent (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, representative_id INTEGER NOT NULL, celebrity_id INTEGER NOT NULL, territory VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_268B9C9DFC3FF006 FOREIGN KEY (representative_id) REFERENCES representative (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_268B9C9D9D12EF95 FOREIGN KEY (celebrity_id) REFERENCES celebrity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO agent (id, representative_id, celebrity_id, territory) SELECT id, representative_id, celebrity_id, territory FROM __temp__agent');
        $this->addSql('DROP TABLE __temp__agent');
        $this->addSql('CREATE INDEX IDX_268B9C9D9D12EF95 ON agent (celebrity_id)');
        $this->addSql('CREATE INDEX IDX_268B9C9DFC3FF006 ON agent (representative_id)');
        $this->addSql('ALTER TABLE change_log_entry ADD COLUMN user VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_B3C77447FE54D947');
        $this->addSql('DROP INDEX IDX_B3C77447A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__fos_user_user_group AS SELECT user_id, group_id FROM fos_user_user_group');
        $this->addSql('DROP TABLE fos_user_user_group');
        $this->addSql('CREATE TABLE fos_user_user_group (user_id INTEGER NOT NULL, group_id INTEGER NOT NULL, PRIMARY KEY(user_id, group_id), CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES fos_user_group (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO fos_user_user_group (user_id, group_id) SELECT user_id, group_id FROM __temp__fos_user_user_group');
        $this->addSql('DROP TABLE __temp__fos_user_user_group');
        $this->addSql('CREATE INDEX IDX_B3C77447FE54D947 ON fos_user_user_group (group_id)');
        $this->addSql('CREATE INDEX IDX_B3C77447A76ED395 ON fos_user_user_group (user_id)');
        $this->addSql('DROP INDEX IDX_FA2425B99D12EF95');
        $this->addSql('DROP INDEX IDX_FA2425B9FC3FF006');
        $this->addSql('CREATE TEMPORARY TABLE __temp__manager AS SELECT id, representative_id, celebrity_id, territory FROM manager');
        $this->addSql('DROP TABLE manager');
        $this->addSql('CREATE TABLE manager (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, representative_id INTEGER NOT NULL, celebrity_id INTEGER NOT NULL, territory VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_FA2425B9FC3FF006 FOREIGN KEY (representative_id) REFERENCES representative (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FA2425B99D12EF95 FOREIGN KEY (celebrity_id) REFERENCES celebrity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO manager (id, representative_id, celebrity_id, territory) SELECT id, representative_id, celebrity_id, territory FROM __temp__manager');
        $this->addSql('DROP TABLE __temp__manager');
        $this->addSql('CREATE INDEX IDX_FA2425B99D12EF95 ON manager (celebrity_id)');
        $this->addSql('CREATE INDEX IDX_FA2425B9FC3FF006 ON manager (representative_id)');
        $this->addSql('DROP INDEX IDX_38C8F80C9D12EF95');
        $this->addSql('DROP INDEX IDX_38C8F80CFC3FF006');
        $this->addSql('CREATE TEMPORARY TABLE __temp__publicist AS SELECT id, representative_id, celebrity_id, territory FROM publicist');
        $this->addSql('DROP TABLE publicist');
        $this->addSql('CREATE TABLE publicist (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, representative_id INTEGER NOT NULL, celebrity_id INTEGER NOT NULL, territory VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_38C8F80CFC3FF006 FOREIGN KEY (representative_id) REFERENCES representative (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_38C8F80C9D12EF95 FOREIGN KEY (celebrity_id) REFERENCES celebrity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO publicist (id, representative_id, celebrity_id, territory) SELECT id, representative_id, celebrity_id, territory FROM __temp__publicist');
        $this->addSql('DROP TABLE __temp__publicist');
        $this->addSql('CREATE INDEX IDX_38C8F80C9D12EF95 ON publicist (celebrity_id)');
        $this->addSql('CREATE INDEX IDX_38C8F80CFC3FF006 ON publicist (representative_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_268B9C9DFC3FF006');
        $this->addSql('DROP INDEX IDX_268B9C9D9D12EF95');
        $this->addSql('CREATE TEMPORARY TABLE __temp__agent AS SELECT id, representative_id, celebrity_id, territory FROM agent');
        $this->addSql('DROP TABLE agent');
        $this->addSql('CREATE TABLE agent (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, representative_id INTEGER NOT NULL, celebrity_id INTEGER NOT NULL, territory VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO agent (id, representative_id, celebrity_id, territory) SELECT id, representative_id, celebrity_id, territory FROM __temp__agent');
        $this->addSql('DROP TABLE __temp__agent');
        $this->addSql('CREATE INDEX IDX_268B9C9DFC3FF006 ON agent (representative_id)');
        $this->addSql('CREATE INDEX IDX_268B9C9D9D12EF95 ON agent (celebrity_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__change_log_entry AS SELECT id, context, identifier, moment, changeset FROM change_log_entry');
        $this->addSql('DROP TABLE change_log_entry');
        $this->addSql('CREATE TABLE change_log_entry (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, context VARCHAR(255) NOT NULL, identifier INTEGER NOT NULL, moment DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , changeset CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO change_log_entry (id, context, identifier, moment, changeset) SELECT id, context, identifier, moment, changeset FROM __temp__change_log_entry');
        $this->addSql('DROP TABLE __temp__change_log_entry');
        $this->addSql('DROP INDEX IDX_B3C77447A76ED395');
        $this->addSql('DROP INDEX IDX_B3C77447FE54D947');
        $this->addSql('CREATE TEMPORARY TABLE __temp__fos_user_user_group AS SELECT user_id, group_id FROM fos_user_user_group');
        $this->addSql('DROP TABLE fos_user_user_group');
        $this->addSql('CREATE TABLE fos_user_user_group (user_id INTEGER NOT NULL, group_id INTEGER NOT NULL, PRIMARY KEY(user_id, group_id))');
        $this->addSql('INSERT INTO fos_user_user_group (user_id, group_id) SELECT user_id, group_id FROM __temp__fos_user_user_group');
        $this->addSql('DROP TABLE __temp__fos_user_user_group');
        $this->addSql('CREATE INDEX IDX_B3C77447A76ED395 ON fos_user_user_group (user_id)');
        $this->addSql('CREATE INDEX IDX_B3C77447FE54D947 ON fos_user_user_group (group_id)');
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
