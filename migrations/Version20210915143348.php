<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210915143348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE posts_save (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_post_id INT NOT NULL, INDEX IDX_EF36036779F37AE5 (id_user_id), INDEX IDX_EF3603679514AA5C (id_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE posts_save ADD CONSTRAINT FK_EF36036779F37AE5 FOREIGN KEY (id_user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE posts_save ADD CONSTRAINT FK_EF3603679514AA5C FOREIGN KEY (id_post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE comments CHANGE notif_comments_id notif_comments_id INT NOT NULL, CHANGE id_comment_parent id_comment_parent INT NOT NULL');
        $this->addSql('ALTER TABLE media CHANGE id_post_id id_post_id INT NOT NULL, CHANGE type type VARCHAR(100) NOT NULL, CHANGE path path VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE posts CHANGE publication_date publication_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA79F37AE5 FOREIGN KEY (id_user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE posts_save');
        $this->addSql('ALTER TABLE comments CHANGE notif_comments_id notif_comments_id INT DEFAULT NULL, CHANGE id_comment_parent id_comment_parent INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media CHANGE id_post_id id_post_id INT DEFAULT NULL, CHANGE type type VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE path path VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA79F37AE5');
        $this->addSql('ALTER TABLE posts CHANGE publication_date publication_date DATETIME DEFAULT NULL');
    }
}
