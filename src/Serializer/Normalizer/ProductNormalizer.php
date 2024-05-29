<?php

namespace App\Serializer\Normalizer;

use App\Entity\Product;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProductNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function normalize($object, ?string $format = null, array $context = []): array
    {
        /** @var Product $object */

        $data['id'] = $object->getId();
        $data['type'] = $object->getType();
        $data['brand'] = $object->getBrand();
        $data['model'] = $object->getModel();
        $data['price'] = $object->getPrice();
        $data['color'] = $object->getColor();
        $data['stock'] = $object->isStock();
        $data['description'] = $object->getDescription();
        $data['image'] = $object->getImage();
        $data['specs'] = $this->normalizer->normalize($object->getSpecs(), $format, ['groups' => ['group:specification:read']]);
        $data['_links'] = [
            'show' => $this->urlGenerator->generate('app_product_details', ['id' => $object->getId()]),
        ];

        return $data;
    }

    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof Product;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [Product::class => true];
    }
}
