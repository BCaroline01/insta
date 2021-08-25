<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210824122651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, id_post_id INT NOT NULL, id_user_id INT NOT NULL, notif_comments_id INT NOT NULL, text LONGTEXT NOT NULL, like_comment TINYINT(1) NOT NULL, id_comment_parent INT NOT NULL, INDEX IDX_5F9E962A9514AA5C (id_post_id), INDEX IDX_5F9E962A79F37AE5 (id_user_id), INDEX IDX_5F9E962AA679FAA (notif_comments_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE followers (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, follower VARCHAR(255) NOT NULL, INDEX IDX_8408FDA779F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hashtags (id INT AUTO_INCREMENT NOT NULL, hashtags_posts_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_21E12BEFD39656AF (hashtags_posts_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hashtags_posts (id INT AUTO_INCREMENT NOT NULL, id_post_id INT NOT NULL, INDEX IDX_42AEBAE9514AA5C (id_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `like` (id INT AUTO_INCREMENT NOT NULL, id_post_id INT NOT NULL, id_user_id INT NOT NULL, INDEX IDX_AC6340B39514AA5C (id_post_id), INDEX IDX_AC6340B379F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, id_post_id INT NOT NULL, type VARCHAR(100) NOT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_6A2CA10C9514AA5C (id_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notif_comments (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, INDEX IDX_F8050DE079F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, content LONGTEXT NOT NULL, geolocation VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_885DBAFA79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE save_posts (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_B5FACF9A79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE save_posts_posts (save_posts_id INT NOT NULL, posts_id INT NOT NULL, INDEX IDX_FF93D67187CF2820 (save_posts_id), INDEX IDX_FF93D671D5E258C5 (posts_id), PRIMARY KEY(save_posts_id, posts_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, dob DATE DEFAULT NULL, description LONGTEXT DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, phone VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A9514AA5C FOREIGN KEY (id_post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A79F37AE5 FOREIGN KEY (id_user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA679FAA FOREIGN KEY (notif_comments_id) REFERENCES notif_comments (id)');
        $this->addSql('ALTER TABLE followers ADD CONSTRAINT FK_8408FDA779F37AE5 FOREIGN KEY (id_user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE hashtags ADD CONSTRAINT FK_21E12BEFD39656AF FOREIGN KEY (hashtags_posts_id) REFERENCES hashtags_posts (id)');
        $this->addSql('ALTER TABLE hashtags_posts ADD CONSTRAINT FK_42AEBAE9514AA5C FOREIGN KEY (id_post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B39514AA5C FOREIGN KEY (id_post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B379F37AE5 FOREIGN KEY (id_user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C9514AA5C FOREIGN KEY (id_post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE notif_comments ADD CONSTRAINT FK_F8050DE079F37AE5 FOREIGN KEY (id_user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA79F37AE5 FOREIGN KEY (id_user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE save_posts ADD CONSTRAINT FK_B5FACF9A79F37AE5 FOREIGN KEY (id_user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE save_posts_posts ADD CONSTRAINT FK_FF93D67187CF2820 FOREIGN KEY (save_posts_id) REFERENCES save_posts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE save_posts_posts ADD CONSTRAINT FK_FF93D671D5E258C5 FOREIGN KEY (posts_id) REFERENCES posts (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hashtags DROP FOREIGN KEY FK_21E12BEFD39656AF');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AA679FAA');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A9514AA5C');
        $this->addSql('ALTER TABLE hashtags_posts DROP FOREIGN KEY FK_42AEBAE9514AA5C');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B39514AA5C');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C9514AA5C');
        $this->addSql('ALTER TABLE save_posts_posts DROP FOREIGN KEY FK_FF93D671D5E258C5');
        $this->addSql('ALTER TABLE save_posts_posts DROP FOREIGN KEY FK_FF93D67187CF2820');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A79F37AE5');
        $this->addSql('ALTER TABLE followers DROP FOREIGN KEY FK_8408FDA779F37AE5');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B379F37AE5');
        $this->addSql('ALTER TABLE notif_comments DROP FOREIGN KEY FK_F8050DE079F37AE5');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA79F37AE5');
        $this->addSql('ALTER TABLE save_posts DROP FOREIGN KEY FK_B5FACF9A79F37AE5');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE followers');
        $this->addSql('DROP TABLE hashtags');
        $this->addSql('DROP TABLE hashtags_posts');
        $this->addSql('DROP TABLE `like`');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE notif_comments');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE save_posts');
        $this->addSql('DROP TABLE save_posts_posts');
        $this->addSql('DROP TABLE users');
    }
}
