<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230202132327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_utilisateur DROP FOREIGN KEY FK_D186451FED5CA9E6');
        $this->addSql('ALTER TABLE service_utilisateur DROP FOREIGN KEY FK_D186451FFB88E14F');
        $this->addSql('DROP TABLE service_utilisateur');
        $this->addSql('DROP TABLE utilisateur_service');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service_utilisateur (service_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_D186451FED5CA9E6 (service_id), INDEX IDX_D186451FFB88E14F (utilisateur_id), PRIMARY KEY(service_id, utilisateur_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur_service (id INT AUTO_INCREMENT NOT NULL, utilisateur INT NOT NULL, service VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE service_utilisateur ADD CONSTRAINT FK_D186451FED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_utilisateur ADD CONSTRAINT FK_D186451FFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
    }
}
