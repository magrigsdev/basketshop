<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250823010550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__cart AS SELECT id, user_id, created_at FROM cart');
        $this->addSql('DROP TABLE cart');
        $this->addSql('CREATE TABLE cart (id VARCHAR(255) NOT NULL, user_id VARCHAR(12) DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cart (id, user_id, created_at) SELECT id, user_id, created_at FROM __temp__cart');
        $this->addSql('DROP TABLE __temp__cart');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA388B7A76ED395 ON cart (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cart_item AS SELECT id, cart_id, product_id, quantity FROM cart_item');
        $this->addSql('DROP TABLE cart_item');
        $this->addSql('CREATE TABLE cart_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cart_id VARCHAR(255) DEFAULT NULL, product_id INTEGER DEFAULT NULL, quantity INTEGER NOT NULL, CONSTRAINT FK_F0FE25271AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F0FE25274584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cart_item (id, cart_id, product_id, quantity) SELECT id, cart_id, product_id, quantity FROM __temp__cart_item');
        $this->addSql('DROP TABLE __temp__cart_item');
        $this->addSql('CREATE INDEX IDX_F0FE25274584665A ON cart_item (product_id)');
        $this->addSql('CREATE INDEX IDX_F0FE25271AD5CDBF ON cart_item (cart_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__contact_message AS SELECT id, name, email, message, create_at FROM contact_message');
        $this->addSql('DROP TABLE contact_message');
        $this->addSql('CREATE TABLE contact_message (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO contact_message (id, name, email, message, create_at) SELECT id, name, email, message, create_at FROM __temp__contact_message');
        $this->addSql('DROP TABLE __temp__contact_message');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order AS SELECT id, user_id, created_at, total_amount, status FROM "order"');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id VARCHAR(12) DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , total_amount NUMERIC(10, 0) NOT NULL, status VARCHAR(255) NOT NULL, CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "order" (id, user_id, created_at, total_amount, status) SELECT id, user_id, created_at, total_amount, status FROM __temp__order');
        $this->addSql('DROP TABLE __temp__order');
        $this->addSql('CREATE INDEX IDX_F5299398A76ED395 ON "order" (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, password, first_name, last_name, address, postal_code, city, roles FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id VARCHAR(12) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) DEFAULT NULL, address CLOB NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , PRIMARY KEY(id))');
        $this->addSql('INSERT INTO user (id, email, password, first_name, last_name, address, postal_code, city, roles) SELECT id, email, password, first_name, last_name, address, postal_code, city, roles FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__visit AS SELECT id, ip, visite_at, path FROM visit');
        $this->addSql('DROP TABLE visit');
        $this->addSql('CREATE TABLE visit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ip VARCHAR(255) NOT NULL, visite_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , path VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO visit (id, ip, visite_at, path) SELECT id, ip, visite_at, path FROM __temp__visit');
        $this->addSql('DROP TABLE __temp__visit');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__cart AS SELECT id, user_id, created_at FROM cart');
        $this->addSql('DROP TABLE cart');
        $this->addSql('CREATE TABLE cart (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cart (id, user_id, created_at) SELECT id, user_id, created_at FROM __temp__cart');
        $this->addSql('DROP TABLE __temp__cart');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA388B7A76ED395 ON cart (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cart_item AS SELECT id, cart_id, product_id, quantity FROM cart_item');
        $this->addSql('DROP TABLE cart_item');
        $this->addSql('CREATE TABLE cart_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cart_id INTEGER DEFAULT NULL, product_id INTEGER DEFAULT NULL, quantity INTEGER NOT NULL, CONSTRAINT FK_F0FE25271AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F0FE25274584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cart_item (id, cart_id, product_id, quantity) SELECT id, cart_id, product_id, quantity FROM __temp__cart_item');
        $this->addSql('DROP TABLE __temp__cart_item');
        $this->addSql('CREATE INDEX IDX_F0FE25271AD5CDBF ON cart_item (cart_id)');
        $this->addSql('CREATE INDEX IDX_F0FE25274584665A ON cart_item (product_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__contact_message AS SELECT id, name, email, message, create_at FROM contact_message');
        $this->addSql('DROP TABLE contact_message');
        $this->addSql('CREATE TABLE contact_message (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO contact_message (id, name, email, message, create_at) SELECT id, name, email, message, create_at FROM __temp__contact_message');
        $this->addSql('DROP TABLE __temp__contact_message');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order AS SELECT id, user_id, created_at, total_amount, status FROM "order"');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , total_amount NUMERIC(10, 0) NOT NULL, status VARCHAR(255) NOT NULL, CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "order" (id, user_id, created_at, total_amount, status) SELECT id, user_id, created_at, total_amount, status FROM __temp__order');
        $this->addSql('DROP TABLE __temp__order');
        $this->addSql('CREATE INDEX IDX_F5299398A76ED395 ON "order" (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, password, first_name, last_name, address, postal_code, city, roles FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) DEFAULT NULL, address CLOB NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, roles VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, password, first_name, last_name, address, postal_code, city, roles) SELECT id, email, password, first_name, last_name, address, postal_code, city, roles FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__visit AS SELECT id, ip, visite_at, path FROM visit');
        $this->addSql('DROP TABLE visit');
        $this->addSql('CREATE TABLE visit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ip VARCHAR(255) NOT NULL, visite_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , path VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO visit (id, ip, visite_at, path) SELECT id, ip, visite_at, path FROM __temp__visit');
        $this->addSql('DROP TABLE __temp__visit');
    }
}
