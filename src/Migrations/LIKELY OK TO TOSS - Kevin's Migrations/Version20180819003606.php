<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180819003606 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE label');
        $this->addSql('DROP TABLE priority');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE target');
        $this->addSql('DROP TABLE task');
        $this->addSql('ALTER TABLE time CHANGE categoryid categoryid INT DEFAULT NULL, CHANGE categorycode categorycode VARCHAR(8) DEFAULT NULL, CHANGE projectid projectid INT DEFAULT NULL, CHANGE projectcode projectcode VARCHAR(8) DEFAULT NULL, CHANGE targetid targetid INT DEFAULT NULL, CHANGE targetcode targetcode VARCHAR(8) DEFAULT NULL, CHANGE type type VARCHAR(1) DEFAULT NULL, CHANGE `group` `group` VARCHAR(32) DEFAULT NULL, CHANGE day day DATETIME DEFAULT NULL, CHANGE internal internal TINYINT(1) DEFAULT NULL, CHANGE description description VARCHAR(768) DEFAULT NULL, CHANGE timenotes timenotes VARCHAR(256) DEFAULT NULL, CHANGE hours hours INT DEFAULT NULL, CHANGE minutes minutes SMALLINT DEFAULT NULL, CHANGE gratishours gratishours INT DEFAULT NULL, CHANGE gratisminutes gratisminutes SMALLINT DEFAULT NULL, CHANGE paid paid TINYINT(1) DEFAULT NULL, CHANGE labels labels VARCHAR(128) DEFAULT NULL, CHANGE created created DATETIME DEFAULT NULL, CHANGE modified modified DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT UNSIGNED AUTO_INCREMENT NOT NULL, parent INT DEFAULT NULL, categorycode VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8_general_ci, `order` VARCHAR(6) DEFAULT \'NULL\' COLLATE utf8_general_ci, name VARCHAR(24) DEFAULT \'NULL\' COLLATE utf8_general_ci, longname VARCHAR(48) DEFAULT \'NULL\' COLLATE utf8_general_ci, notes VARCHAR(256) DEFAULT \'NULL\' COLLATE utf8_general_ci, `table` VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8_general_ci, labels VARCHAR(128) DEFAULT \'NULL\' COLLATE utf8_general_ci, created DATETIME DEFAULT \'\'0000-00-00 00:00:00\'\', modified DATETIME DEFAULT \'current_timestamp()\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE label (id INT UNSIGNED AUTO_INCREMENT NOT NULL, labelcode VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8_general_ci, categoryid INT DEFAULT NULL, `order` VARCHAR(6) DEFAULT \'NULL\' COLLATE utf8_general_ci, name VARCHAR(24) DEFAULT \'NULL\' COLLATE utf8_general_ci, longname VARCHAR(48) DEFAULT \'NULL\' COLLATE utf8_general_ci, notes VARCHAR(256) DEFAULT \'NULL\' COLLATE utf8_general_ci, `table` VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8_general_ci, created DATETIME DEFAULT \'\'0000-00-00 00:00:00\'\', modified DATETIME DEFAULT \'current_timestamp()\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE priority (id INT UNSIGNED AUTO_INCREMENT NOT NULL, prioritycode VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8_general_ci, `order` VARCHAR(6) DEFAULT \'NULL\' COLLATE utf8_general_ci, name VARCHAR(24) DEFAULT \'NULL\' COLLATE utf8_general_ci, longname VARCHAR(48) DEFAULT \'NULL\' COLLATE utf8_general_ci, notes VARCHAR(256) DEFAULT \'NULL\' COLLATE utf8_general_ci, created DATETIME DEFAULT \'\'0000-00-00 00:00:00\'\', modified DATETIME DEFAULT \'current_timestamp()\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT UNSIGNED AUTO_INCREMENT NOT NULL, projectcode VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8_general_ci, categoryid INT DEFAULT NULL, categorycode VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8_general_ci, typeid INT DEFAULT NULL, typecode VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8_general_ci, name VARCHAR(24) DEFAULT \'NULL\' COLLATE utf8_general_ci, longname VARCHAR(48) DEFAULT \'NULL\' COLLATE utf8_general_ci, notes VARCHAR(256) DEFAULT \'NULL\' COLLATE utf8_general_ci, labels VARCHAR(128) DEFAULT \'NULL\' COLLATE utf8_general_ci, created DATETIME DEFAULT \'\'0000-00-00 00:00:00\'\', modified DATETIME DEFAULT \'current_timestamp()\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE target (id INT UNSIGNED AUTO_INCREMENT NOT NULL, targetcode VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8_general_ci, categoryid INT DEFAULT NULL, projectid INT DEFAULT NULL, priorityid INT DEFAULT NULL, `order` VARCHAR(6) DEFAULT \'NULL\' COLLATE utf8_general_ci, name VARCHAR(24) DEFAULT \'NULL\' COLLATE utf8_general_ci, longname VARCHAR(48) DEFAULT \'NULL\' COLLATE utf8_general_ci, notes VARCHAR(256) DEFAULT \'NULL\' COLLATE utf8_general_ci, startdate DATE DEFAULT \'NULL\', enddate DATE DEFAULT \'NULL\', hourslow INT DEFAULT NULL, minuteslow INT DEFAULT NULL, hourshigh INT DEFAULT NULL, minuteshigh INT DEFAULT NULL, labels VARCHAR(128) DEFAULT \'NULL\' COLLATE utf8_general_ci, created DATETIME DEFAULT \'\'0000-00-00 00:00:00\'\', modified DATETIME DEFAULT \'current_timestamp()\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT UNSIGNED AUTO_INCREMENT NOT NULL, `order` VARCHAR(6) DEFAULT \'NULL\' COLLATE utf8_general_ci, name VARCHAR(24) DEFAULT \'NULL\' COLLATE utf8_general_ci, longname VARCHAR(48) DEFAULT \'NULL\' COLLATE utf8_general_ci, notes VARCHAR(256) DEFAULT \'NULL\' COLLATE utf8_general_ci, `table` VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8_general_ci, recordid INT DEFAULT NULL, labels VARCHAR(128) DEFAULT \'NULL\' COLLATE utf8_general_ci, created DATETIME DEFAULT \'\'0000-00-00 00:00:00\'\', modified DATETIME DEFAULT \'current_timestamp()\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE time CHANGE categoryid categoryid INT DEFAULT NULL, CHANGE categorycode categorycode VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE projectid projectid INT DEFAULT NULL, CHANGE projectcode projectcode VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE targetid targetid INT DEFAULT NULL, CHANGE targetcode targetcode VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE type type VARCHAR(1) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE `group` `group` VARCHAR(32) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE day day DATETIME DEFAULT \'NULL\', CHANGE internal internal TINYINT(1) DEFAULT \'NULL\', CHANGE description description VARCHAR(768) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE timenotes timenotes VARCHAR(256) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE hours hours INT DEFAULT NULL, CHANGE minutes minutes SMALLINT DEFAULT NULL, CHANGE gratishours gratishours INT DEFAULT NULL, CHANGE gratisminutes gratisminutes SMALLINT DEFAULT NULL, CHANGE paid paid TINYINT(1) DEFAULT \'NULL\', CHANGE labels labels VARCHAR(128) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE created created DATETIME DEFAULT \'NULL\', CHANGE modified modified DATETIME DEFAULT \'NULL\'');
    }
}
