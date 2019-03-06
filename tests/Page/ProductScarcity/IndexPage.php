<?php

declare(strict_types=1);

namespace App\Tests\Page\ProductScarcity;

use Behat\Mink\Element\NodeElement;
use Sylius\Behat\Page\Admin\Crud\IndexPage as BaseIndexPage;

final class IndexPage extends BaseIndexPage implements IndexPageInterface
{
    public function isProductScarce(string $productName): bool
    {
        return null !== $this->findScarceRowForProduct($productName);
    }

    public function deleteProductScarcity(string $productName): void
    {
        $scarceRow = $this->findScarceRowForProduct($productName);

        $scarceRow->pressButton('Delete');
    }

    private function findScarceRowForProduct(string $productName): ?NodeElement
    {
        /** @var array $scarceRows */
        $scarceRows = $this->getElement('table')->findAll('css', 'tr');

        /** @var NodeElement $scarceRow */
        foreach ($scarceRows as $scarceRow) {
            if (strpos($scarceRow->getText(), $productName) != false) {
                return $scarceRow;
            }
        }

        return null;
    }
}
