<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $OrderDate;

    #[ORM\Column(type: 'datetime')]
    private $OrderDelivery;

    #[ORM\Column(type: 'string', length: 255)]
    private $OrderStatus;

    #[ORM\ManyToOne(targetEntity: Customers::class, inversedBy: 'orders')]
    private $customers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->OrderDate;
    }

    public function setOrderDate(\DateTimeInterface $OrderDate): self
    {
        $this->OrderDate = $OrderDate;

        return $this;
    }

    public function getOrderDelivery(): ?\DateTimeInterface
    {
        return $this->OrderDelivery;
    }

    public function setOrderDelivery(\DateTimeInterface $OrderDelivery): self
    {
        $this->OrderDelivery = $OrderDelivery;

        return $this;
    }

    public function getOrderStatus(): ?string
    {
        return $this->OrderStatus;
    }

    public function setOrderStatus(string $OrderStatus): self
    {
        $this->OrderStatus = $OrderStatus;

        return $this;
    }

    public function getCustomers(): ?Customers
    {
        return $this->customers;
    }

    public function setCustomers(?Customers $customers): self
    {
        $this->customers = $customers;

        return $this;
    }
}
