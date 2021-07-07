<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210707091453 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE TABLE pizzeria_pizza (pizzeria_id INT NOT NULL, pizza_id INT NOT NULL, INDEX IDX_9F9B6E20F1965E46 (pizzeria_id), INDEX IDX_9F9B6E20D41D1D42 (pizza_id), PRIMARY KEY(pizzeria_id, pizza_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE pizzeria_pizza ADD CONSTRAINT FK_9F9B6E20F1965E46 FOREIGN KEY (pizzeria_id) REFERENCES pizzeria (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE pizzeria_pizza ADD CONSTRAINT FK_9F9B6E20D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nombre_ingredient_par_pizza ADD pizza_id INT NOT NULL');
        $this->addSql('ALTER TABLE nombre_ingredient_par_pizza ADD CONSTRAINT FK_551E6DE2D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id)');
        $this->addSql('CREATE INDEX IDX_551E6DE2D41D1D42 ON nombre_ingredient_par_pizza (pizza_id)');
        $this->addSql('ALTER TABLE pizzaiolo DROP FOREIGN KEY FK_8E1DFF22F1965E46');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pizzeria_pizza');
        $this->addSql('ALTER TABLE nombre_ingredient_par_pizza DROP FOREIGN KEY FK_551E6DE2D41D1D42');
        $this->addSql('DROP INDEX IDX_551E6DE2D41D1D42 ON nombre_ingredient_par_pizza');
        $this->addSql('ALTER TABLE nombre_ingredient_par_pizza DROP pizza_id');
        $this->addSql('ALTER TABLE pizzaiolo ADD CONSTRAINT FK_8E1DFF22F1965E46 FOREIGN KEY (pizzeria_id) REFERENCES pizzeria (id_pizzeria)');
    }
}
