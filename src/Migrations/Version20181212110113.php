<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181212110113 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE type');
        $this->addSql('ALTER TABLE galerie CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE page CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE referencement CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE langue CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user_historique CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user_newsletter CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user_reinitialisation CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, galerie_id INT DEFAULT NULL, created DATETIME NOT NULL, changed DATETIME DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_8CDE5729825396CB (galerie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE5729825396CB FOREIGN KEY (galerie_id) REFERENCES galerie (id)');
        $this->addSql('ALTER TABLE galerie CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE langue CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE page CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE referencement CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user_historique CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user_newsletter CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user_reinitialisation CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
    }
}
