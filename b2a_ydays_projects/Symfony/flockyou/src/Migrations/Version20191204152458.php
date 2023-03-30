<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191204152458 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE leagues (id INT AUTO_INCREMENT NOT NULL, league VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, league_id INT NOT NULL, team_id INT NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, flocage VARCHAR(255) NOT NULL, size VARCHAR(4) NOT NULL, price VARCHAR(255) NOT NULL, INDEX IDX_B3BA5A5A58AFC4DE (league_id), INDEX IDX_B3BA5A5A296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teams (id INT AUTO_INCREMENT NOT NULL, league_id INT NOT NULL, team VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_96C2225858AFC4DE (league_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A58AFC4DE FOREIGN KEY (league_id) REFERENCES leagues (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A296CD8AE FOREIGN KEY (team_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE teams ADD CONSTRAINT FK_96C2225858AFC4DE FOREIGN KEY (league_id) REFERENCES leagues (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A58AFC4DE');
        $this->addSql('ALTER TABLE teams DROP FOREIGN KEY FK_96C2225858AFC4DE');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A296CD8AE');
        $this->addSql('DROP TABLE leagues');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE teams');
    }
}
