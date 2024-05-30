<?php

namespace App\Serializer\Normalizer;

use App\Entity\Specification;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SpecificationNormalizer implements NormalizerInterface
{
    public function normalize($object, ?string $format = null, array $context = []): array
    {
        /** @var Specification $object */

        $data['id'] = $object->getId();
        $data['weight'] = $object->getWeight();
        $data['resolution'] = $object->getResolution();
        $data['processor'] = $object->getProcessor();
        $data['ram'] = $object->getRam();
        $data['storage'] = $object->getStorage();
        $data['battery'] = $object->getBattery();
        $data['os'] = $object->getOs();

        return $data;
    }

    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof Specification;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [Specification::class => true];
    }
}
