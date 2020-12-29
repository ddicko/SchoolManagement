<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201219173816 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE note_matter (note_id INT NOT NULL, matter_id INT NOT NULL, INDEX IDX_A80CCCBB26ED0855 (note_id), INDEX IDX_A80CCCBBD614E59F (matter_id), PRIMARY KEY(note_id, matter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE note_matter ADD CONSTRAINT FK_A80CCCBB26ED0855 FOREIGN KEY (note_id) REFERENCES note (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE note_matter ADD CONSTRAINT FK_A80CCCBBD614E59F FOREIGN KEY (matter_id) REFERENCES matter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14D614E59F');
        $this->addSql('DROP INDEX UNIQ_CFBDFA14D614E59F ON note');
        $this->addSql('ALTER TABLE note DROP matter_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE note_matter');
        $this->addSql('ALTER TABLE note ADD matter_id INT NOT NULL');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14D614E59F FOREIGN KEY (matter_id) REFERENCES matter (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFBDFA14D614E59F ON note (matter_id)');
    }
}
