<?php

declare(strict_types=1);

namespace App\Entity\Product;

use Sylius\Component\Resource\Model\ResourceInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="app_product_scarcity")
 */
final class ProductScarcity implements ResourceInterface
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $productVariantName;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $quantityLeft;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(type="datetime")
     */
    private $since;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $status;

    public function __construct()
    {
        $this->since = new \DateTimeImmutable();
        $this->status = 'new';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getProductVariantName(): ?string
    {
        return $this->productVariantName;
    }

    public function setProductVariantName(?string $productVariantName): void
    {
        $this->productVariantName = $productVariantName;
    }

    public function getQuantityLeft(): ?int
    {
        return $this->quantityLeft;
    }

    public function setQuantityLeft(?int $quantityLeft): void
    {
        $this->quantityLeft = $quantityLeft;
    }

    public function getSince(): \DateTimeInterface
    {
        return $this->since;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
