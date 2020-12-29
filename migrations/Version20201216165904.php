<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216165904 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teacher_remuneration ADD classroom_id INT DEFAULT NULL, ADD matter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE teacher_remuneration ADD CONSTRAINT FK_8FB6C1B96278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
        $this->addSql('ALTER TABLE teacher_remuneration ADD CONSTRAINT FK_8FB6C1B9D614E59F FOREIGN KEY (matter_id) REFERENCES matter (id)');
        $this->addSql('CREATE INDEX IDX_8FB6C1B96278D5A8 ON teacher_remuneration (classroom_id)');
        $this->addSql('CREATE INDEX IDX_8FB6C1B9D614E59F ON teacher_remuneration (matter_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teacher_remuneration DROP FOREIGN KEY FK_8FB6C1B96278D5A8');
        $this->addSql('ALTER TABLE teacher_remuneration DROP FOREIGN KEY FK_8FB6C1B9D614E59F');
        $this->addSql('DROP INDEX IDX_8FB6C1B96278D5A8 ON teacher_remuneration');
        $this->addSql('DROP INDEX IDX_8FB6C1B9D614E59F ON teacher_remuneration');
        $this->addSql('ALTER TABLE teacher_remuneration DROP classroom_id, DROP matter_id');
    }
}
