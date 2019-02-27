<?php

declare(strict_types=1);

namespace App\Tests\Context;

use App\Entity\Product\ProductScarcity;
use App\Tests\Page\ProductScarcity\IndexPageInterface;
use App\Tests\Page\ProductScarcity\ShowPageInterface;
use Behat\Behat\Context\Context;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Webmozart\Assert\Assert;

final class ManagingProductScarcityContext implements Context
{
    /** @var IndexPageInterface */
    private $indexPage;

    /** @var ShowPageInterface */
    private $showPage;

    /** @var RepositoryInterface */
    private $productScarcityRepository;

    public function __construct(
        IndexPageInterface $indexPage,
        ShowPageInterface $showPage,
        RepositoryInterface $productScarcityRepository
    ) {
        $this->indexPage = $indexPage;
        $this->showPage = $showPage;
        $this->productScarcityRepository = $productScarcityRepository;
    }

    /**
     * @When I browse product scarcity list
     */
    public function browseProductScarcityList(): void
    {
        $this->indexPage->open();
    }

    /**
     * @Then I should see that :productName product is scarce
     */
    public function shouldSeeThatProductIsScarce(string $productName): void
    {
        Assert::true($this->indexPage->isProductScarce($productName));
    }

    /**
     * @When I delete scarcity for product :productName
     */
    public function deleteScarcityForProduct(string $productName): void
    {
        $this->indexPage->deleteProductScarcity($productName);
    }

    /**
     * @Then there should not be any product scarcity
     */
    public function thereShouldNotBeAnyProductScarcity(): void
    {
        Assert::eq($this->indexPage->countItems(), 0);
    }

    /**
     * @When I see the scarcity of product :productName
     */
    public function seeScarcityOfProduct(string $productName): void
    {
        $this->indexPage->open();

        /** @var ProductScarcity $productScarcity */
        $productScarcity = $this->productScarcityRepository->findOneBy(['productVariantName' => $productName]);

        $this->showPage->open(['id' => $productScarcity->getId()]);
    }

    /**
     * @Then I should see that there are :itemQuantity items left at stock
     */
    public function shouldSeeThatThereAreItemsLeftAtStock(string $itemQuantity): void
    {
        Assert::true($this->showPage->hasItemQuantity($itemQuantity));
    }
}
