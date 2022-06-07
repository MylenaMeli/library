<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220604050752 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, type_account_id INT DEFAULT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, etat INT NOT NULL, INDEX IDX_7D3656A48668899F (type_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adherent (id INT AUTO_INCREMENT NOT NULL, account_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, date_naiss DATE NOT NULL, picture VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_90D3F0609B6B5FBA (account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, domain_id INT DEFAULT NULL, account_id INT DEFAULT NULL, project_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date_pub DATE NOT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_D8698A76115F0EE5 (domain_id), INDEX IDX_D8698A769B6B5FBA (account_id), UNIQUE INDEX UNIQ_D8698A76166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_adherent (document_id INT NOT NULL, adherent_id INT NOT NULL, INDEX IDX_1F120139C33F7837 (document_id), INDEX IDX_1F12013925F06C53 (adherent_id), PRIMARY KEY(document_id, adherent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domain (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `like` (id INT AUTO_INCREMENT NOT NULL, document_id INT DEFAULT NULL, INDEX IDX_AC6340B3C33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, document_id INT DEFAULT NULL, description LONGTEXT NOT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_6A2CA10CC33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personal (id INT AUTO_INCREMENT NOT NULL, adherent_id INT DEFAULT NULL, poste_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_F18A6D8425F06C53 (adherent_id), INDEX IDX_F18A6D84A0905086 (poste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poste (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, document_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_C42F7784C33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, adherent_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_B723AF3325F06C53 (adherent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_account (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A48668899F FOREIGN KEY (type_account_id) REFERENCES type_account (id)');
        $this->addSql('ALTER TABLE adherent ADD CONSTRAINT FK_90D3F0609B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76115F0EE5 FOREIGN KEY (domain_id) REFERENCES domain (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A769B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE document_adherent ADD CONSTRAINT FK_1F120139C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_adherent ADD CONSTRAINT FK_1F12013925F06C53 FOREIGN KEY (adherent_id) REFERENCES adherent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3C33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CC33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE personal ADD CONSTRAINT FK_F18A6D8425F06C53 FOREIGN KEY (adherent_id) REFERENCES adherent (id)');
        $this->addSql('ALTER TABLE personal ADD CONSTRAINT FK_F18A6D84A0905086 FOREIGN KEY (poste_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784C33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3325F06C53 FOREIGN KEY (adherent_id) REFERENCES adherent (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adherent DROP FOREIGN KEY FK_90D3F0609B6B5FBA');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A769B6B5FBA');
        $this->addSql('ALTER TABLE document_adherent DROP FOREIGN KEY FK_1F12013925F06C53');
        $this->addSql('ALTER TABLE personal DROP FOREIGN KEY FK_F18A6D8425F06C53');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF3325F06C53');
        $this->addSql('ALTER TABLE document_adherent DROP FOREIGN KEY FK_1F120139C33F7837');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3C33F7837');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CC33F7837');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784C33F7837');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76115F0EE5');
        $this->addSql('ALTER TABLE personal DROP FOREIGN KEY FK_F18A6D84A0905086');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76166D1F9C');
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A48668899F');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE adherent');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE document_adherent');
        $this->addSql('DROP TABLE domain');
        $this->addSql('DROP TABLE `like`');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE personal');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE report');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE type_account');
    }
}
