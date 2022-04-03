<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220403023014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE emplacement (id_emplacement INT AUTO_INCREMENT NOT NULL, type_emplacement VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id_emplacement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id_resv INT AUTO_INCREMENT NOT NULL, tab_resv INT DEFAULT NULL, phone_resv INT NOT NULL, email_resv VARCHAR(50) NOT NULL, date_resv DATETIME NOT NULL, end_resv DATETIME NOT NULL, INDEX IDX_42C84955ADD86EF9 (tab_resv), PRIMARY KEY(id_resv)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `table` (id_tab INT AUTO_INCREMENT NOT NULL, emp INT DEFAULT NULL, nb_chaise_tab INT NOT NULL, stock_tab INT NOT NULL, INDEX IDX_F6298F46310BB40F (emp), PRIMARY KEY(id_tab)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955ADD86EF9 FOREIGN KEY (tab_resv) REFERENCES `table` (id_tab) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `table` ADD CONSTRAINT FK_F6298F46310BB40F FOREIGN KEY (emp) REFERENCES emplacement (id_emplacement) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `table` DROP FOREIGN KEY FK_F6298F46310BB40F');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955ADD86EF9');
        $this->addSql('DROP TABLE emplacement');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE `table`');
    }
}
