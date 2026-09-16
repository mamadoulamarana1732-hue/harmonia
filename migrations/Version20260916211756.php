<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260916211756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, release_at DATE NOT NULL, cover VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, image_path VARCHAR(255) NOT NULL, artist_id INT NOT NULL, INDEX IDX_39986E43B7970CF8 (artist_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, biography VARCHAR(255) NOT NULL, country_origin VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE history (id INT AUTO_INCREMENT NOT NULL, datehour DATETIME NOT NULL, nbercount INT NOT NULL, created_at DATETIME NOT NULL, son_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_27BA704B65EFA242 (son_id), INDEX IDX_27BA704BA76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE playlist (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, ispublic TINYINT NOT NULL, date_c DATE NOT NULL, created_at DATETIME NOT NULL, user_id INT NOT NULL, INDEX IDX_D782112DA76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE son (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, duration TIME NOT NULL, tracknumber VARCHAR(255) NOT NULL, counter INT NOT NULL, is_explicite TINYINT NOT NULL, created_at DATETIME NOT NULL, albums_id INT DEFAULT NULL, INDEX IDX_E199342CECBB55AF (albums_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE son_playlist (son_id INT NOT NULL, playlist_id INT NOT NULL, INDEX IDX_3B4883B565EFA242 (son_id), INDEX IDX_3B4883B56BBD148 (playlist_id), PRIMARY KEY (son_id, playlist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE son_type (son_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_1F24CB1365EFA242 (son_id), INDEX IDX_1F24CB13C54C8C93 (type_id), PRIMARY KEY (son_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, created DATETIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E43B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B65EFA242 FOREIGN KEY (son_id) REFERENCES son (id)');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE son ADD CONSTRAINT FK_E199342CECBB55AF FOREIGN KEY (albums_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE son_playlist ADD CONSTRAINT FK_3B4883B565EFA242 FOREIGN KEY (son_id) REFERENCES son (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE son_playlist ADD CONSTRAINT FK_3B4883B56BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE son_type ADD CONSTRAINT FK_1F24CB1365EFA242 FOREIGN KEY (son_id) REFERENCES son (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE son_type ADD CONSTRAINT FK_1F24CB13C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E43B7970CF8');
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704B65EFA242');
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704BA76ED395');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112DA76ED395');
        $this->addSql('ALTER TABLE son DROP FOREIGN KEY FK_E199342CECBB55AF');
        $this->addSql('ALTER TABLE son_playlist DROP FOREIGN KEY FK_3B4883B565EFA242');
        $this->addSql('ALTER TABLE son_playlist DROP FOREIGN KEY FK_3B4883B56BBD148');
        $this->addSql('ALTER TABLE son_type DROP FOREIGN KEY FK_1F24CB1365EFA242');
        $this->addSql('ALTER TABLE son_type DROP FOREIGN KEY FK_1F24CB13C54C8C93');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE history');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('DROP TABLE son');
        $this->addSql('DROP TABLE son_playlist');
        $this->addSql('DROP TABLE son_type');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
