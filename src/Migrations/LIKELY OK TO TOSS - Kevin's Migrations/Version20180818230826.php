<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180818230826 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE time ADD targetid INT DEFAULT NULL, ADD targetcode VARCHAR(8) DEFAULT NULL, ADD type VARCHAR(1) DEFAULT NULL, ADD `group` VARCHAR(32) DEFAULT NULL, ADD internal TINYINT(1) DEFAULT NULL, ADD gratishours INT DEFAULT NULL, ADD gratisminutes SMALLINT DEFAULT NULL, CHANGE categoryid categoryid INT DEFAULT NULL, CHANGE categorycode categorycode VARCHAR(8) DEFAULT NULL, CHANGE projectid projectid INT DEFAULT NULL, CHANGE projectcode projectcode VARCHAR(8) DEFAULT NULL, CHANGE day day DATETIME DEFAULT NULL, CHANGE description description VARCHAR(768) DEFAULT NULL, CHANGE timenotes timenotes VARCHAR(256) DEFAULT NULL, CHANGE hours hours INT DEFAULT NULL, CHANGE minutes minutes SMALLINT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE time DROP targetid, DROP targetcode, DROP type, DROP `group`, DROP internal, DROP gratishours, DROP gratisminutes, CHANGE categoryid categoryid INT DEFAULT NULL, CHANGE categorycode categorycode VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE projectid projectid INT DEFAULT NULL, CHANGE projectcode projectcode VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE day day DATETIME DEFAULT \'NULL\', CHANGE description description VARCHAR(768) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE timenotes timenotes VARCHAR(256) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE hours hours INT DEFAULT NULL, CHANGE minutes minutes SMALLINT DEFAULT NULL');
    }
}
