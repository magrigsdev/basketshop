<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250806041002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'update database schema for basketshop application';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA388B7A76ED395 ON cart (user_id)');
        $this->addSql('CREATE TABLE cart_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cart_id INTEGER DEFAULT NULL, product_id INTEGER DEFAULT NULL, quantity INTEGER NOT NULL, CONSTRAINT FK_F0FE25271AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F0FE25274584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_F0FE25271AD5CDBF ON cart_item (cart_id)');
        $this->addSql('CREATE INDEX IDX_F0FE25274584665A ON cart_item (product_id)');
        $this->addSql('CREATE TABLE contact_message (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , total_amount NUMERIC(10, 0) NOT NULL, status VARCHAR(255) NOT NULL, CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_F5299398A76ED395 ON "order" (user_id)');
        $this->addSql('CREATE TABLE order_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, product_id INTEGER DEFAULT NULL, orders_id INTEGER DEFAULT NULL, CONSTRAINT FK_52EA1F094584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_52EA1F09CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_52EA1F094584665A ON order_item (product_id)');
        $this->addSql('CREATE INDEX IDX_52EA1F09CFFE9AD6 ON order_item (orders_id)');
        $this->addSql('CREATE TABLE visit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ip VARCHAR(255) NOT NULL, visite_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , path VARCHAR(255) NOT NULL)');
        $this->addSql('ALTER TABLE user ADD COLUMN roles VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_item');
        $this->addSql('DROP TABLE contact_message');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE order_item');
        $this->addSql('DROP TABLE visit');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, password, first_name, last_name, address, postal_code, city FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) DEFAULT NULL, address CLOB NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, password, first_name, last_name, address, postal_code, city) SELECT id, email, password, first_name, last_name, address, postal_code, city FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
