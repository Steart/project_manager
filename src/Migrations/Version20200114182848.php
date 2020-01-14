<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200114182848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('INSERT INTO user (username, roles, password) VALUES(?, ?, ?)', ['admin', json_encode(['ROLE_ADMIN']), '$2y$13$P7oXg0VkUo9q8c3oDaqlqO2Apq4z1Ft2AAkLrLTFhI2Ho1ylW5O5u']);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
