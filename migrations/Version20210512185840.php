<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210512185840 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meeting (id INT AUTO_INCREMENT NOT NULL, doctor_id INT NOT NULL, patient_id INT NOT NULL, date DATETIME NOT NULL, status INT DEFAULT 1 NOT NULL, INDEX IDX_F515E13987F4FB17 (doctor_id), INDEX IDX_F515E1396B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meeting_procedure (meeting_id INT NOT NULL, procedure_id INT NOT NULL, INDEX IDX_6A160B6967433D9C (meeting_id), INDEX IDX_6A160B691624BCD2 (procedure_id), PRIMARY KEY(meeting_id, procedure_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `procedure` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, cost NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meeting ADD CONSTRAINT FK_F515E13987F4FB17 FOREIGN KEY (doctor_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE meeting ADD CONSTRAINT FK_F515E1396B899279 FOREIGN KEY (patient_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE meeting_procedure ADD CONSTRAINT FK_6A160B6967433D9C FOREIGN KEY (meeting_id) REFERENCES meeting (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meeting_procedure ADD CONSTRAINT FK_6A160B691624BCD2 FOREIGN KEY (procedure_id) REFERENCES `procedure` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meeting_procedure DROP FOREIGN KEY FK_6A160B6967433D9C');
        $this->addSql('ALTER TABLE meeting_procedure DROP FOREIGN KEY FK_6A160B691624BCD2');
        $this->addSql('DROP TABLE meeting');
        $this->addSql('DROP TABLE meeting_procedure');
        $this->addSql('DROP TABLE `procedure`');
    }
}
