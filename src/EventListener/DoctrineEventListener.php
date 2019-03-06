<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Creator\ProductScarcityCreatorInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\OrderItemInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;
use Sylius\Component\Core\OrderCheckoutStates;
use Sylius\Component\Inventory\Checker\AvailabilityCheckerInterface;

final class DoctrineEventListener
{
    /** @var ProductScarcityCreatorInterface */
    private $productScarcityCreator;

    /** @var AvailabilityCheckerInterface */
    private $availabilityChecker;

    public function __construct(
        ProductScarcityCreatorInterface $productScarcityCreator,
        AvailabilityCheckerInterface $availabilityChecker
    ) {
        $this->productScarcityCreator = $productScarcityCreator;
        $this->availabilityChecker = $availabilityChecker;
    }

    public function postPersist(LifecycleEventArgs $event): void
    {
        $order = $event->getEntity();

        if (
            !$order instanceof OrderInterface ||
            $order->getCheckoutState() !== OrderCheckoutStates::STATE_COMPLETED
        ) {
            return;
        }

        $this->processCompletedOrder($order);
    }

    public function postUpdate(LifecycleEventArgs $event): void
    {
        $order = $event->getEntity();

        if (!$order instanceof OrderInterface) {
            return;
        }

        $entityManager = $event->getEntityManager();

        $unitOfWork = $entityManager->getUnitOfWork();
        $changeSet = $unitOfWork->getEntityChangeSet($order);

        if (
            !isset($changeSet['checkoutState']) ||
            $changeSet['checkoutState'][1] !== OrderCheckoutStates::STATE_COMPLETED
        ) {
            return;
        }

        $this->processCompletedOrder($order);
    }

    private function processCompletedOrder(OrderInterface $order): void
    {
        /** @var Collection $orderItems */
        $orderItems = $order->getItems();

        $productVariants = array_map(function(OrderItemInterface $orderItem) {
            return $orderItem->getVariant();
        }, $orderItems->toArray());

        /** @var ProductVariantInterface $productVariant */
        foreach ($productVariants as $productVariant) {
            if (!$this->availabilityChecker->isStockSufficient($productVariant, 5)) {
                $this->createProductScarcity($productVariant);
            }
        }
    }

    private function createProductScarcity(ProductVariantInterface $productVariant): void
    {
        $this->productScarcityCreator->__invoke($productVariant);
    }
}
