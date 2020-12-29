<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216152813 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matter ADD classroom_id INT DEFAULT NULL, ADD amount_paid_for_matter INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matter ADD CONSTRAINT FK_B0DE9B6F6278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
        $this->addSql('CREATE INDEX IDX_B0DE9B6F6278D5A8 ON matter (classroom_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matter DROP FOREIGN KEY FK_B0DE9B6F6278D5A8');
        $this->addSql('DROP INDEX IDX_B0DE9B6F6278D5A8 ON matter');
        $this->addSql('ALTER TABLE matter DROP classroom_id, DROP amount_paid_for_matter');
    }
}
