<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180828062213 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE time (id INT AUTO_INCREMENT NOT NULL, categoryid INT DEFAULT NULL, categorycode VARCHAR(8) DEFAULT NULL, projectid INT DEFAULT NULL, projectcode VARCHAR(8) DEFAULT NULL, targetid INT DEFAULT NULL, targetcode VARCHAR(8) DEFAULT NULL, type VARCHAR(1) DEFAULT NULL, groups VARCHAR(32) DEFAULT NULL, day DATETIME DEFAULT NULL, internal TINYINT(1) DEFAULT NULL, description VARCHAR(768) DEFAULT NULL, timenotes VARCHAR(256) DEFAULT NULL, hours INT DEFAULT NULL, minutes SMALLINT DEFAULT NULL, gratishours INT DEFAULT NULL, gratisminutes SMALLINT DEFAULT NULL, temp TINYINT(1) DEFAULT NULL, malformed VARCHAR(1024) DEFAULT NULL, invoicenum INT DEFAULT NULL, paid TINYINT(1) DEFAULT NULL, labels VARCHAR(128) DEFAULT NULL, created DATETIME DEFAULT NULL, modified DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(191) NOT NULL, fullname VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE time');
        $this->addSql('DROP TABLE user');
    }
}
