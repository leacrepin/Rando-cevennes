<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201005073232 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incription_rando (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incription_rando_randonnee (incription_rando_id INT NOT NULL, randonnee_id INT NOT NULL, INDEX IDX_2288F1DB3E596213 (incription_rando_id), INDEX IDX_2288F1DBC8C97C3C (randonnee_id), PRIMARY KEY(incription_rando_id, randonnee_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE randonnee (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, duree DATE NOT NULL, date_rando DATE NOT NULL, INDEX IDX_CB71A99FBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE incription_rando_randonnee ADD CONSTRAINT FK_2288F1DB3E596213 FOREIGN KEY (incription_rando_id) REFERENCES incription_rando (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incription_rando_randonnee ADD CONSTRAINT FK_2288F1DBC8C97C3C FOREIGN KEY (randonnee_id) REFERENCES randonnee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE randonnee ADD CONSTRAINT FK_CB71A99FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE randonnee DROP FOREIGN KEY FK_CB71A99FBCF5E72D');
        $this->addSql('ALTER TABLE incription_rando_randonnee DROP FOREIGN KEY FK_2288F1DB3E596213');
        $this->addSql('ALTER TABLE incription_rando_randonnee DROP FOREIGN KEY FK_2288F1DBC8C97C3C');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE incription_rando');
        $this->addSql('DROP TABLE incription_rando_randonnee');
        $this->addSql('DROP TABLE randonnee');
    }
}
