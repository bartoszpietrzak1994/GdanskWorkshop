<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product\ProductScarcity;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class ProductScarcityShowAction
{
    /** @var RepositoryInterface */
    private $productScarcityRepository;

    /** @var Environment */
    private $twig;

    public function __construct(RepositoryInterface $productScarcityRepository, Environment $twig)
    {
        $this->productScarcityRepository = $productScarcityRepository;
        $this->twig = $twig;
    }

    public function __invoke(string $id)
    {
        /** @var ProductScarcity $productScarcity */
        $productScarcity = $this->productScarcityRepository->find($id);

        return new Response(
            $this->twig->render('ProductScarcity/show.html.twig', ['productScarcity' => $productScarcity])
        );
    }
}
