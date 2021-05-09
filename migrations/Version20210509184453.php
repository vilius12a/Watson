<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210509184453 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meeting (id INT AUTO_INCREMENT NOT NULL, procedure_id_id INT NOT NULL, patient_id INT NOT NULL, doctor_id INT NOT NULL, INDEX IDX_F515E1399C3F211D (procedure_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `procedure` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, cost DOUBLE PRECISION NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meeting ADD CONSTRAINT FK_F515E1399C3F211D FOREIGN KEY (procedure_id_id) REFERENCES `procedure` (id)');
        $this->addSql('ALTER TABLE meeting ADD state VARCHAR(255) NOT NULL, ADD description LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meeting DROP FOREIGN KEY FK_F515E1399C3F211D');
        $this->addSql('DROP TABLE meeting');
        $this->addSql('DROP TABLE `procedure`');
        $this->addSql('ALTER TABLE meeting DROP state, DROP description');
    }
}
