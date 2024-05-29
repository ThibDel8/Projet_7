<?php

namespace App\Serializer\Normalizer;

use App\Entity\Address;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AddressNormalizer implements NormalizerInterface
{
    public function normalize($object, ?string $format = null, array $context = []): array
    {
        /** @var Address $object */

        $data['id'] = $object->getId();
        $data['street'] = $object->getStreet();
        $data['zipCode'] = $object->getZipCode();
        $data['city'] = $object->getCity();
        $data['country'] = $object->getCountry();

        return $data;
    }

    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof Address;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [Address::class => true];
    }
}
