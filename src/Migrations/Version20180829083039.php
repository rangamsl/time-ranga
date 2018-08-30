<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180829083039 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE timeold');
        $this->addSql('ALTER TABLE time ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE time ADD CONSTRAINT FK_6F949845A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6F949845A76ED395 ON time (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE timeold (id INT AUTO_INCREMENT NOT NULL, categoryid INT DEFAULT NULL, categorycode VARCHAR(8) DEFAULT NULL COLLATE utf8_general_ci, projectcode VARCHAR(8) DEFAULT NULL COLLATE utf8_general_ci, targetid INT DEFAULT NULL, targetcode VARCHAR(8) DEFAULT NULL COLLATE utf8_general_ci, type VARCHAR(1) DEFAULT NULL COLLATE utf8_general_ci, `group` VARCHAR(32) DEFAULT NULL COLLATE utf8_general_ci, internal TINYINT(1) DEFAULT NULL, gratishours INT DEFAULT NULL, gratisminutes SMALLINT DEFAULT NULL, temp TINYINT(1) DEFAULT NULL, malformed VARCHAR(1024) DEFAULT NULL COLLATE utf8_general_ci, invoicenum INT DEFAULT NULL, paid TINYINT(1) DEFAULT NULL, labels VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, created DATETIME DEFAULT NULL, modified DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE time DROP FOREIGN KEY FK_6F949845A76ED395');
        $this->addSql('DROP INDEX IDX_6F949845A76ED395 ON time');
        $this->addSql('ALTER TABLE time DROP user_id');
    }
}
