<?php

declare(strict_types=1);

namespace App\Tests\Page\ProductScarcity;

use FriendsOfBehat\PageObjectExtension\Page\SymfonyPage;

final class ShowPage extends SymfonyPage implements ShowPageInterface
{
    public function getRouteName(): string
    {
        return 'app_admin_product_scarcity_show';
    }

    public function hasItemQuantity(string $expectedItemQuantity): bool
    {
        $itemQuantity = $this->getDocument()->find('css', '#item-quantity');

        if (null === $itemQuantity) {
            return false;
        }

        return $itemQuantity->getText() === $expectedItemQuantity;
    }
}
