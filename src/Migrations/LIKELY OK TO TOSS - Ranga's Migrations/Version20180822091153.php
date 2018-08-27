<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180822091153 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE time CHANGE categoryid categoryid INT NOT NULL, CHANGE categorycode categorycode VARCHAR(8) NOT NULL, CHANGE projectid projectid INT NOT NULL, CHANGE projectcode projectcode VARCHAR(8) NOT NULL, CHANGE targetid targetid INT NOT NULL, CHANGE targetcode targetcode VARCHAR(8) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE time CHANGE categoryid categoryid INT DEFAULT NULL, CHANGE categorycode categorycode VARCHAR(8) DEFAULT NULL COLLATE utf8_general_ci, CHANGE projectid projectid INT DEFAULT NULL, CHANGE projectcode projectcode VARCHAR(8) DEFAULT NULL COLLATE utf8_general_ci, CHANGE targetid targetid INT DEFAULT NULL, CHANGE targetcode targetcode VARCHAR(8) DEFAULT NULL COLLATE utf8_general_ci');
    }
}
