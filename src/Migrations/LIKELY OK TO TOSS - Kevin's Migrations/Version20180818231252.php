<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180818231252 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE time ADD paid TINYINT(1) DEFAULT NULL, ADD labels VARCHAR(128) DEFAULT NULL, ADD created DATETIME DEFAULT NULL, ADD modified DATETIME DEFAULT NULL, CHANGE categoryid categoryid INT DEFAULT NULL, CHANGE categorycode categorycode VARCHAR(8) DEFAULT NULL, CHANGE projectid projectid INT DEFAULT NULL, CHANGE projectcode projectcode VARCHAR(8) DEFAULT NULL, CHANGE targetid targetid INT DEFAULT NULL, CHANGE targetcode targetcode VARCHAR(8) DEFAULT NULL, CHANGE type type VARCHAR(1) DEFAULT NULL, CHANGE `group` `group` VARCHAR(32) DEFAULT NULL, CHANGE day day DATETIME DEFAULT NULL, CHANGE internal internal TINYINT(1) DEFAULT NULL, CHANGE description description VARCHAR(768) DEFAULT NULL, CHANGE timenotes timenotes VARCHAR(256) DEFAULT NULL, CHANGE hours hours INT DEFAULT NULL, CHANGE minutes minutes SMALLINT DEFAULT NULL, CHANGE gratishours gratishours INT DEFAULT NULL, CHANGE gratisminutes gratisminutes SMALLINT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE time DROP paid, DROP labels, DROP created, DROP modified, CHANGE categoryid categoryid INT DEFAULT NULL, CHANGE categorycode categorycode VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE projectid projectid INT DEFAULT NULL, CHANGE projectcode projectcode VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE targetid targetid INT DEFAULT NULL, CHANGE targetcode targetcode VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE type type VARCHAR(1) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE `group` `group` VARCHAR(32) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE day day DATETIME DEFAULT \'NULL\', CHANGE internal internal TINYINT(1) DEFAULT \'NULL\', CHANGE description description VARCHAR(768) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE timenotes timenotes VARCHAR(256) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE hours hours INT DEFAULT NULL, CHANGE minutes minutes SMALLINT DEFAULT NULL, CHANGE gratishours gratishours INT DEFAULT NULL, CHANGE gratisminutes gratisminutes SMALLINT DEFAULT NULL');
    }
}
