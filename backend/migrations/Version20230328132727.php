<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328132727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE fruit_id_seq');
        $this->addSql('SELECT setval(\'fruit_id_seq\', (SELECT MAX(id) FROM fruit))');
        $this->addSql('ALTER TABLE fruit ALTER id SET DEFAULT nextval(\'fruit_id_seq\')');
        $this->addSql('ALTER TABLE fruit ALTER nutritions TYPE JSON');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE fruit ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE fruit ALTER nutritions TYPE JSON');
    }
}
