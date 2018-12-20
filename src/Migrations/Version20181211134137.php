<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181211134137 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE galerie_categorie (galerie_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_ABBF71DE825396CB (galerie_id), INDEX IDX_ABBF71DEBCF5E72D (categorie_id), PRIMARY KEY(galerie_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE galerie_categorie ADD CONSTRAINT FK_ABBF71DE825396CB FOREIGN KEY (galerie_id) REFERENCES galerie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE galerie_categorie ADD CONSTRAINT FK_ABBF71DEBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE galerie DROP FOREIGN KEY FK_9E7D1590BCF5E72D');
        $this->addSql('DROP INDEX IDX_9E7D1590BCF5E72D ON galerie');
        $this->addSql('ALTER TABLE galerie DROP categorie_id, CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE langue CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE page CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE referencement CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user_historique CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user_newsletter CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user_reinitialisation CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE galerie_categorie');
        $this->addSql('ALTER TABLE galerie ADD categorie_id INT DEFAULT NULL, CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE galerie ADD CONSTRAINT FK_9E7D1590BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_9E7D1590BCF5E72D ON galerie (categorie_id)');
        $this->addSql('ALTER TABLE langue CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE page CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE referencement CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user_historique CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user_newsletter CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user_reinitialisation CHANGE created created DATETIME NOT NULL, CHANGE changed changed DATETIME DEFAULT NULL');
    }
}
