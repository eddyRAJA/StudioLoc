<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307080629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE about_us (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, poster VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_studio (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, poster VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, poster VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, studio_id INT NOT NULL, amount NUMERIC(8, 2) DEFAULT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL, registered TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_42C84955F675F31B (author_id), INDEX IDX_42C84955446F285F (studio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE studio (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, summary LONGTEXT DEFAULT NULL, poster VARCHAR(255) DEFAULT NULL, unit_price NUMERIC(8, 2) DEFAULT NULL, detail LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL, INDEX IDX_4A2B07B612469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, phone VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, linkedin VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955446F285F FOREIGN KEY (studio_id) REFERENCES studio (id)');
        $this->addSql('ALTER TABLE studio ADD CONSTRAINT FK_4A2B07B612469DE2 FOREIGN KEY (category_id) REFERENCES category_studio (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE studio DROP FOREIGN KEY FK_4A2B07B612469DE2');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955446F285F');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955F675F31B');
        $this->addSql('DROP TABLE about_us');
        $this->addSql('DROP TABLE category_studio');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE studio');
        $this->addSql('DROP TABLE user');
    }
}
