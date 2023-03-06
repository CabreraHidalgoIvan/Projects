<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230304140436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarea ADD estado_id INT NOT NULL');
        $this->addSql('ALTER TABLE tarea ADD CONSTRAINT FK_3CA053669F5A440B FOREIGN KEY (estado_id) REFERENCES estado_tarea (id)');
        $this->addSql('CREATE INDEX IDX_3CA053669F5A440B ON tarea (estado_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarea DROP FOREIGN KEY FK_3CA053669F5A440B');
        $this->addSql('DROP INDEX IDX_3CA053669F5A440B ON tarea');
        $this->addSql('ALTER TABLE tarea DROP estado_id');
    }
}
