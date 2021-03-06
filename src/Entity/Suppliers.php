<?php

namespace App\Entity;

use App\Repository\SuppliersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuppliersRepository::class)]
class Suppliers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $SupplierName;

    #[ORM\Column(type: 'string', length: 255)]
    private $SupplierNation;

    #[ORM\OneToMany(mappedBy: 'suppliers', targetEntity: Products::class)]
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplierName(): ?string
    {
        return $this->SupplierName;
    }

    public function setSupplierName(string $SupplierName): self
    {
        $this->SupplierName = $SupplierName;

        return $this;
    }

    public function getSupplierNation(): ?string
    {
        return $this->SupplierNation;
    }

    public function setSupplierNation(string $SupplierNation): self
    {
        $this->SupplierNation = $SupplierNation;

        return $this;
    }

    /**
     * @return Collection<int, Products>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setSuppliers($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getSuppliers() === $this) {
                $product->setSuppliers(null);
            }
        }

        return $this;
    }
}
