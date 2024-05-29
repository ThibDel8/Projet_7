<?php

namespace App\Serializer\Normalizer;

use App\Entity\User;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UserNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function normalize($object, ?string $format = null, array $context = []): array
    {
        /** @var User $object */

        $data['id'] = $object->getId();
        $data['username'] = $object->getUsername();
        $data['email'] = $object->getEmail();
        $data['firstname'] = $object->getFirstname();
        $data['lastname'] = $object->getLastname();
        $data['phoneNumber'] = $object->getPhoneNumber();
        $data['address'] = $this->normalizer->normalize($object->getAddresses()->toArray(), $format, ['groups' => ['group:address:read']]);
        $data['_links'] = [
            'show' => $this->urlGenerator->generate('app_user_details', ['id' => $object->getId()]),
        ];

        return $data;
    }

    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [User::class => true];
    }
}
