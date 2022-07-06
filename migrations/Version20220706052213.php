<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706052213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customers (id INT AUTO_INCREMENT NOT NULL, cus_username VARCHAR(100) NOT NULL, cus_password VARCHAR(255) NOT NULL, cus_roles LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orderdetails (id INT AUTO_INCREMENT NOT NULL, products_id INT DEFAULT NULL, orders_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_489AFCDC6C8A81A9 (products_id), INDEX IDX_489AFCDCCFFE9AD6 (orders_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, customers_id INT DEFAULT NULL, order_date DATETIME NOT NULL, order_delivery DATETIME NOT NULL, order_status VARCHAR(255) NOT NULL, INDEX IDX_E52FFDEEC3568B40 (customers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, suppliers_id INT DEFAULT NULL, product_name VARCHAR(255) NOT NULL, product_description VARCHAR(255) NOT NULL, product_price INT NOT NULL, product_quantity INT NOT NULL, product_status VARCHAR(255) NOT NULL, product_image VARCHAR(255) NOT NULL, INDEX IDX_B3BA5A5A355AF43 (suppliers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suppliers (id INT AUTO_INCREMENT NOT NULL, supplier_name VARCHAR(255) NOT NULL, supplier_nation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orderdetails ADD CONSTRAINT FK_489AFCDC6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE orderdetails ADD CONSTRAINT FK_489AFCDCCFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEC3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A355AF43 FOREIGN KEY (suppliers_id) REFERENCES suppliers (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEC3568B40');
        $this->addSql('ALTER TABLE orderdetails DROP FOREIGN KEY FK_489AFCDCCFFE9AD6');
        $this->addSql('ALTER TABLE orderdetails DROP FOREIGN KEY FK_489AFCDC6C8A81A9');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A355AF43');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE orderdetails');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE suppliers');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
