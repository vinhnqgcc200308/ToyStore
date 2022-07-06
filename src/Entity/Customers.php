<?php

namespace App\Entity;

use App\Repository\CustomersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomersRepository::class)]
class Customers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $CusUsername;

    #[ORM\Column(type: 'string', length: 255)]
    private $CusPassword;

    #[ORM\Column(type: 'text')]
    private $CusRoles;

    #[ORM\OneToMany(mappedBy: 'customers', targetEntity: Orders::class)]
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCusUsername(): ?string
    {
        return $this->CusUsername;
    }

    public function setCusUsername(string $CusUsername): self
    {
        $this->CusUsername = $CusUsername;

        return $this;
    }

    public function getCusPassword(): ?string
    {
        return $this->CusPassword;
    }

    public function setCusPassword(string $CusPassword): self
    {
        $this->CusPassword = $CusPassword;

        return $this;
    }

    public function getCusRoles(): ?string
    {
        return $this->CusRoles;
    }

    public function setCusRoles(string $CusRoles): self
    {
        $this->CusRoles = $CusRoles;

        return $this;
    }

    /**
     * @return Collection<int, Orders>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Orders $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setCustomers($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCustomers() === $this) {
                $order->setCustomers(null);
            }
        }

        return $this;
    }
}
