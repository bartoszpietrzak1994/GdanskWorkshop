<?php

declare(strict_types=1);

namespace App\Tests\Context;

use Behat\Behat\Context\Context;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Component\Core\Model\AdminUserInterface;
use Sylius\Component\Core\Test\Services\EmailCheckerInterface;
use Webmozart\Assert\Assert;

final class ProductScarcityEmailContext implements Context
{
    /** @var EmailCheckerInterface */
    private $emailChecker;

    /** @var SharedStorageInterface */
    private $sharedStorage;

    public function __construct(EmailCheckerInterface $emailChecker, SharedStorageInterface $sharedStorage)
    {
        $this->emailChecker = $emailChecker;
        $this->sharedStorage = $sharedStorage;
    }

    /**
     * @Then I should receive an email informing about :productName product scarcity
     */
    public function shouldReceiveEmailInformingAboutProductScarcity(string $productName): void
    {
        /** @var AdminUserInterface $administrator */
        $administrator = $this->sharedStorage->get('administrator');

        Assert::true(
            $this->emailChecker->hasMessageTo(sprintf('%s is scarce', $productName),
                $administrator->getEmail())
        );
    }
}
