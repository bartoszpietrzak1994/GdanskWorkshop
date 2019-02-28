<?php

declare(strict_types=1);

namespace App\Ui\Menu;

use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function __invoke(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        /** @var ItemInterface $salesMenu */
        $salesMenu = $menu->getChild('catalog');

        $salesMenu
            ->addChild('product_scarcity', ['route' => 'app_admin_product_scarcity_index'])
            ->setLabel('app.ui.product_scarcity')
            ->setLabelAttribute('icon', 'file')
        ;
    }
}
