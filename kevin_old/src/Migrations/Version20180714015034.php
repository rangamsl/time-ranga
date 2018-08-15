<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180714015034 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE article');
        $this->addSql('ALTER TABLE time MODIFY num INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE time DROP FOREIGN KEY time_project');
        $this->addSql('DROP INDEX entry_group ON time');
        $this->addSql('ALTER TABLE time DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE time ADD id INT AUTO_INCREMENT NOT NULL, ADD typenum INT NOT NULL, ADD categorynum INT NOT NULL, DROP num, DROP category, DROP internal, CHANGE projectnum projectnum INT DEFAULT NULL, CHANGE projectid projectid VARCHAR(8) DEFAULT NULL, CHANGE day day DATE DEFAULT NULL, CHANGE description description VARCHAR(768) DEFAULT NULL, CHANGE timenotes timenotes VARCHAR(256) DEFAULT NULL, CHANGE hours hours INT NOT NULL, CHANGE minutes minutes INT DEFAULT NULL, CHANGE gratishours gratishours INT DEFAULT NULL, CHANGE gratisminutes gratisminutes INT DEFAULT NULL, CHANGE invoicenum invoicenum INT DEFAULT NULL, CHANGE paid paid TINYINT(1) DEFAULT NULL, CHANGE created created DATETIME NOT NULL, CHANGE modified modified TIME DEFAULT NULL');
        $this->addSql('ALTER TABLE time ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, title TINYTEXT NOT NULL COLLATE utf8mb4_unicode_ci, body LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE time MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE time DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE time ADD num INT UNSIGNED AUTO_INCREMENT NOT NULL, ADD category VARCHAR(32) DEFAULT \'NULL\' COLLATE utf8_general_ci, ADD internal TINYINT(1) DEFAULT \'NULL\', DROP id, DROP typenum, DROP categorynum, CHANGE projectnum projectnum INT UNSIGNED DEFAULT NULL, CHANGE projectid projectid VARCHAR(8) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE day day DATE DEFAULT \'NULL\', CHANGE description description VARCHAR(768) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE timenotes timenotes VARCHAR(256) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE hours hours INT DEFAULT NULL, CHANGE minutes minutes INT DEFAULT NULL, CHANGE gratishours gratishours INT DEFAULT NULL, CHANGE gratisminutes gratisminutes INT DEFAULT NULL, CHANGE invoicenum invoicenum INT UNSIGNED DEFAULT NULL, CHANGE paid paid TINYINT(1) DEFAULT \'NULL\', CHANGE created created DATETIME DEFAULT \'\'0000-00-00 00:00:00\'\' NOT NULL, CHANGE modified modified DATETIME DEFAULT \'current_timestamp()\'');
        $this->addSql('ALTER TABLE time ADD CONSTRAINT time_project FOREIGN KEY (projectnum) REFERENCES project (projectnum) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('CREATE INDEX entry_group ON time (projectnum)');
        $this->addSql('ALTER TABLE time ADD PRIMARY KEY (num)');
    }
}
