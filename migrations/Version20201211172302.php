<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201211172302 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE enseignant (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phonenumbers VARCHAR(255) NOT NULL, age INT DEFAULT NULL, address VARCHAR(255) NOT NULL, siteweb VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseignant_matter (enseignant_id INT NOT NULL, matter_id INT NOT NULL, INDEX IDX_C929810DE455FCC0 (enseignant_id), INDEX IDX_C929810DD614E59F (matter_id), PRIMARY KEY(enseignant_id, matter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enseignant_matter ADD CONSTRAINT FK_C929810DE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enseignant_matter ADD CONSTRAINT FK_C929810DD614E59F FOREIGN KEY (matter_id) REFERENCES matter (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enseignant_matter DROP FOREIGN KEY FK_C929810DE455FCC0');
        $this->addSql('DROP TABLE enseignant');
        $this->addSql('DROP TABLE enseignant_matter');
    }
}
