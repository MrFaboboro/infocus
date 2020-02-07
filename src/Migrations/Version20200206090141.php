<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200206090141 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE camera (id INT AUTO_INCREMENT NOT NULL, camerabrand VARCHAR(255) NOT NULL, cameratype VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_foto (category_id INT NOT NULL, foto_id INT NOT NULL, INDEX IDX_614741A212469DE2 (category_id), INDEX IDX_614741A27ABFA656 (foto_id), PRIMARY KEY(category_id, foto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, comment VARCHAR(999) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE foto (id INT AUTO_INCREMENT NOT NULL, camera_id INT DEFAULT NULL, comment_id INT DEFAULT NULL, user_id INT NOT NULL, titel VARCHAR(255) NOT NULL, beschrijving VARCHAR(255) NOT NULL, fileurl VARCHAR(255) NOT NULL, INDEX IDX_EADC3BE5B47685CD (camera_id), INDEX IDX_EADC3BE5F8697D13 (comment_id), INDEX IDX_EADC3BE5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recensie (id INT AUTO_INCREMENT NOT NULL, reviewtext VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, age DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_foto ADD CONSTRAINT FK_614741A212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_foto ADD CONSTRAINT FK_614741A27ABFA656 FOREIGN KEY (foto_id) REFERENCES foto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE foto ADD CONSTRAINT FK_EADC3BE5B47685CD FOREIGN KEY (camera_id) REFERENCES camera (id)');
        $this->addSql('ALTER TABLE foto ADD CONSTRAINT FK_EADC3BE5F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE foto ADD CONSTRAINT FK_EADC3BE5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE foto DROP FOREIGN KEY FK_EADC3BE5B47685CD');
        $this->addSql('ALTER TABLE category_foto DROP FOREIGN KEY FK_614741A212469DE2');
        $this->addSql('ALTER TABLE foto DROP FOREIGN KEY FK_EADC3BE5F8697D13');
        $this->addSql('ALTER TABLE category_foto DROP FOREIGN KEY FK_614741A27ABFA656');
        $this->addSql('ALTER TABLE foto DROP FOREIGN KEY FK_EADC3BE5A76ED395');
        $this->addSql('DROP TABLE camera');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_foto');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE foto');
        $this->addSql('DROP TABLE recensie');
        $this->addSql('DROP TABLE user');
    }
}
