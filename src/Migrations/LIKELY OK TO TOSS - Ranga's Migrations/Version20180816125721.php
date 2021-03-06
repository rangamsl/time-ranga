<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180816125721 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE time DROP projectid, DROP day, DROP description, DROP timenotes, DROP hours, DROP minutes');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE time ADD projectid VARCHAR(280) NOT NULL COLLATE utf8mb4_unicode_ci, ADD day DATETIME NOT NULL, ADD description VARCHAR(280) NOT NULL COLLATE utf8mb4_unicode_ci, ADD timenotes VARCHAR(280) NOT NULL COLLATE utf8mb4_unicode_ci, ADD hours DATETIME NOT NULL, ADD minutes DATETIME NOT NULL');
    }
}
