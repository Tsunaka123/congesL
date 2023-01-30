<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230126100735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX FK_DELEGATION_DELEGANT ON delegation');
        $this->addSql('DROP INDEX `primary` ON delegation');
        $this->addSql('ALTER TABLE delegation ADD id_user_delegant_d_id INT NOT NULL, DROP id_user_delegant_d, CHANGE id_user_delegue_d id_user_delegue_d INT NOT NULL');
        $this->addSql('ALTER TABLE delegation ADD CONSTRAINT FK_292F436D891D292D FOREIGN KEY (id_user_delegant_d_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_292F436D891D292D ON delegation (id_user_delegant_d_id)');
        $this->addSql('ALTER TABLE delegation ADD PRIMARY KEY (id_user_delegue_d, id_user_delegant_d_id)');
        $this->addSql('ALTER TABLE service MODIFY idServiceS INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON service');
        $this->addSql('ALTER TABLE service DROP libServiceS, DROP calendarServiceS, DROP preferenceMailS, DROP preferenceValidationS, DROP idDirecteurS, DROP idAdminS, DROP anneeCouranteS, DROP planningSpecialS, DROP ordreUserDansPlanningS, CHANGE idServiceS id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE service ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE sous_service MODIFY idSServiceSS INT NOT NULL');
        $this->addSql('DROP INDEX FK_SS_SERVICE ON sous_service');
        $this->addSql('DROP INDEX `primary` ON sous_service');
        $this->addSql('ALTER TABLE sous_service DROP libSServiceSS, DROP idServiceSS, CHANGE idSServiceSS id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE sous_service ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE delegation DROP FOREIGN KEY FK_292F436D891D292D');
        $this->addSql('DROP INDEX IDX_292F436D891D292D ON delegation');
        $this->addSql('DROP INDEX `PRIMARY` ON delegation');
        $this->addSql('ALTER TABLE delegation ADD id_user_delegant_d INT NOT NULL COMMENT \'Charge idUserDelegueD de poser ses congés à sa place\', DROP id_user_delegant_d_id, CHANGE id_user_delegue_d id_user_delegue_d INT NOT NULL COMMENT \'Chargé de poser les congés\'');
        $this->addSql('CREATE INDEX FK_DELEGATION_DELEGANT ON delegation (id_user_delegant_d)');
        $this->addSql('ALTER TABLE delegation ADD PRIMARY KEY (id_user_delegue_d, id_user_delegant_d)');
        $this->addSql('ALTER TABLE service MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON service');
        $this->addSql('ALTER TABLE service ADD libServiceS VARCHAR(100) NOT NULL, ADD calendarServiceS VARCHAR(100) NOT NULL COMMENT \'Lien agenda Google (Module ZEND)\', ADD preferenceMailS TINYINT(1) NOT NULL COMMENT \'Booleen: mail envoyé à chaue demande?\', ADD preferenceValidationS TINYINT(1) NOT NULL COMMENT \'Booleen: Un jour posé = validé (si VRAI)\', ADD idDirecteurS INT NOT NULL, ADD idAdminS INT NOT NULL, ADD anneeCouranteS INT NOT NULL, ADD planningSpecialS INT DEFAULT 0 NOT NULL COMMENT \'1 si le service souhaite avoir le planning sur l\'\'application\', ADD ordreUserDansPlanningS VARCHAR(100) DEFAULT NULL, CHANGE id idServiceS INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE service ADD PRIMARY KEY (idServiceS)');
        $this->addSql('ALTER TABLE sous_service MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON sous_service');
        $this->addSql('ALTER TABLE sous_service ADD libSServiceSS VARCHAR(50) NOT NULL, ADD idServiceSS INT NOT NULL, CHANGE id idSServiceSS INT AUTO_INCREMENT NOT NULL');
        $this->addSql('CREATE INDEX FK_SS_SERVICE ON sous_service (idServiceSS)');
        $this->addSql('ALTER TABLE sous_service ADD PRIMARY KEY (idSServiceSS)');
    }
}
