<?php

declare(strict_types=1);

namespace App\Tests\Page\ProductScarcity;

use FriendsOfBehat\PageObjectExtension\Page\SymfonyPageInterface;

interface ShowPageInterface extends SymfonyPageInterface
{
    public function hasItemQuantity(string $expectedItemQuantity): bool;
}
