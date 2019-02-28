<?php

declare(strict_types=1);

namespace App\Creator;

use App\Entity\Product\ProductScarcity;
use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Component\Core\Model\ProductVariantInterface;

final class ProductScarcityCreator implements ProductScarcityCreatorInterface
{
    /** @var ObjectManager */
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function __invoke(ProductVariantInterface $productVariant): void
    {
        $productScarcity = new ProductScarcity();
        $productScarcity->setProductVariantName($productVariant->getName());
        $productScarcity->setQuantityLeft($productVariant->getOnHand() - $productVariant->getOnHold());

        $this->objectManager->persist($productScarcity);
        $this->objectManager->flush();
    }
}
