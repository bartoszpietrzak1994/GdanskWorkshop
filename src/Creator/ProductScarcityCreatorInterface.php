<?php

declare(strict_types=1);

namespace App\Creator;

use Sylius\Component\Core\Model\ProductVariantInterface;

interface ProductScarcityCreatorInterface
{
    public function __invoke(ProductVariantInterface $productVariant): void;
}
