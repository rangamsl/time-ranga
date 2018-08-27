<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180818222227 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE time CHANGE projectid projectid VARCHAR(8) DEFAULT NULL, CHANGE day day DATETIME DEFAULT NULL, CHANGE description description VARCHAR(768) DEFAULT NULL, CHANGE timenotes timenotes VARCHAR(256) DEFAULT NULL, CHANGE hours hours DATETIME DEFAULT NULL, CHANGE minutes minutes DATETIME DEFAULT NULL, CHANGE projectcode projectcode INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE time CHANGE projectid projectid VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE day day DATETIME DEFAULT \'NULL\', CHANGE description description VARCHAR(768) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE timenotes timenotes VARCHAR(256) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE hours hours DATETIME DEFAULT \'NULL\', CHANGE minutes minutes DATETIME DEFAULT \'NULL\', CHANGE projectcode projectcode INT DEFAULT NULL');
    }
}
