<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210908073612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, content LONGTEXT NOT NULL, geolocation VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, publication_date DATETIME DEFAULT NULL, INDEX IDX_885DBAFA79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your need
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, content LONGTEXT NOT NULL, geolocation VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, publication_date DATETIME DEFAULT NULL, INDEX IDX_885DBAFA79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }
}
