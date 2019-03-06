<?php

declare(strict_types=1);

namespace App\Tests\Page\ProductScarcity;

use \Sylius\Behat\Page\Admin\Crud\IndexPageInterface as BaseIndexPageInterface;

interface IndexPageInterface extends BaseIndexPageInterface
{
    public function isProductScarce(string $productName): bool;

    public function deleteProductScarcity(string $productName): void;
}
