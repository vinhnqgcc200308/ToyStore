<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $ProductName;

    #[ORM\Column(type: 'string', length: 255)]
    private $ProductDescription;

    #[ORM\Column(type: 'integer')]
    private $ProductPrice;

    #[ORM\Column(type: 'integer')]
    private $ProductQuantity;

    #[ORM\Column(type: 'string', length: 255)]
    private $ProductStatus;

    #[ORM\Column(type: 'string', length: 255)]
    private $ProductImage;

    #[ORM\ManyToOne(targetEntity: Suppliers::class, inversedBy: 'products')]
    private $suppliers;

    #[ORM\OneToMany(mappedBy: 'products', targetEntity: Orderdetails::class)]
    private $orderdetails;

    public function __construct()
    {
        $this->orderdetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->ProductName;
    }

    public function setProductName(string $ProductName): self
    {
        $this->ProductName = $ProductName;

        return $this;
    }

    public function getProductDescription(): ?string
    {
        return $this->ProductDescription;
    }

    public function setProductDescription(string $ProductDescription): self
    {
        $this->ProductDescription = $ProductDescription;

        return $this;
    }

    public function getProductPrice(): ?int
    {
        return $this->ProductPrice;
    }

    public function setProductPrice(int $ProductPrice): self
    {
        $this->ProductPrice = $ProductPrice;

        return $this;
    }

    public function getProductQuantity(): ?int
    {
        return $this->ProductQuantity;
    }

    public function setProductQuantity(int $ProductQuantity): self
    {
        $this->ProductQuantity = $ProductQuantity;

        return $this;
    }

    public function getProductStatus(): ?string
    {
        return $this->ProductStatus;
    }

    public function setProductStatus(string $ProductStatus): self
    {
        $this->ProductStatus = $ProductStatus;

        return $this;
    }

    public function getProductImage(): ?string
    {
        return $this->ProductImage;
    }

    public function setProductImage(string $ProductImage): self
    {
        $this->ProductImage = $ProductImage;

        return $this;
    }

    public function getSuppliers(): ?Suppliers
    {
        return $this->suppliers;
    }

    public function setSuppliers(?Suppliers $suppliers): self
    {
        $this->suppliers = $suppliers;

        return $this;
    }

    /**
     * @return Collection<int, Orderdetails>
     */
    public function getOrderdetails(): Collection
    {
        return $this->orderdetails;
    }

    public function addOrderdetail(Orderdetails $orderdetail): self
    {
        if (!$this->orderdetails->contains($orderdetail)) {
            $this->orderdetails[] = $orderdetail;
            $orderdetail->setProducts($this);
        }

        return $this;
    }

    public function removeOrderdetail(Orderdetails $orderdetail): self
    {
        if ($this->orderdetails->removeElement($orderdetail)) {
            // set the owning side to null (unless already changed)
            if ($orderdetail->getProducts() === $this) {
                $orderdetail->setProducts(null);
            }
        }

        return $this;
    }
}
