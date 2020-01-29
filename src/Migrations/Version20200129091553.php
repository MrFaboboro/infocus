<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129091553 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE foto ADD camera_id INT NOT NULL');
        $this->addSql('ALTER TABLE foto ADD CONSTRAINT FK_EADC3BE5B47685CD FOREIGN KEY (camera_id) REFERENCES camera (id)');
        $this->addSql('CREATE INDEX IDX_EADC3BE5B47685CD ON foto (camera_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE foto DROP FOREIGN KEY FK_EADC3BE5B47685CD');
        $this->addSql('DROP INDEX IDX_EADC3BE5B47685CD ON foto');
        $this->addSql('ALTER TABLE foto DROP camera_id');
    }
}
