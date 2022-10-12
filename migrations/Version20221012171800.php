<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221012171800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE files (id INT AUTO_INCREMENT NOT NULL, submitted VARCHAR(100) NOT NULL, mean_kinetic_temperature DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_files (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, file_id INT NOT NULL, temperature VARCHAR(100) NOT NULL, date_time VARCHAR(100) NOT NULL, INDEX IDX_E4F7BB01A76ED395 (user_id), INDEX IDX_E4F7BB0193CB796C (file_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, ip_address VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_files ADD CONSTRAINT FK_E4F7BB01A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_files ADD CONSTRAINT FK_E4F7BB0193CB796C FOREIGN KEY (file_id) REFERENCES files (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_files DROP FOREIGN KEY FK_E4F7BB01A76ED395');
        $this->addSql('ALTER TABLE user_files DROP FOREIGN KEY FK_E4F7BB0193CB796C');
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP TABLE user_files');
        $this->addSql('DROP TABLE users');
    }
}
