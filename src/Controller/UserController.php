<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class UserController extends AbstractController
{
    #[Route('/api/users', name: 'app_users', methods: ['GET'])]
    public function getAllUsers(UserRepository $repository, SerializerInterface $serializer, Request $request, TagAwareCacheInterface $cache): JsonResponse
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);

        if ($page < 1) {
            return new JsonResponse(['message' => 'Numéro de page invalide !'], Response::HTTP_BAD_REQUEST, [], false);
        }

        $idCache = "getAllUsers-" . $page . "-" . $limit;

        $json = $cache->get($idCache, function (ItemInterface $item) use ($repository, $page, $limit, $serializer) {
            $item->tag("usersCache");
            $client = $this->getUser();
            $usersList = $repository->findAllWithPagination($page, $limit, $client);

            return $serializer->serialize($usersList, 'json', ['groups' => ['group:user:index']]);
        });

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/api/users/{id}', name: 'app_user_details', methods: ['GET'])]
    public function getThisUser(User $user): JsonResponse
    {
        $client = $this->getUser();
        $userClient = $user->getClient();

        if ($client === $userClient) {

            return $this->json($user, Response::HTTP_OK, [], ['groups' => 'group:user:read']);
        }

        return new JsonResponse(['message' => 'Accès refusé, vous n\'êtes pas l\'administrateur de cet utilisateur !'], Response::HTTP_FORBIDDEN);
    }

    #[Route('/api/users/{id}', name: 'app_delete_user', methods: ['DELETE'])]
    public function deleteUser(User $user, EntityManagerInterface $entityManager, TagAwareCacheInterface $cache): JsonResponse
    {
        $client = $this->getUser();
        $userClient = $user->getClient();

        if ($client === $userClient) {
            $entityManager->remove($user);
            $entityManager->flush();

            $cache->invalidateTags(["usersCache"]);

            return new JsonResponse(['message' => 'L\'utilisateur à bien été supprimé !'], Response::HTTP_OK); //Remplacement de HTTP_NO_CONTENT par HTTP_OK sinon le message ne s'affiche pas
        }

        return new JsonResponse(['message' => 'Accès refusé, vous n\'êtes pas l\'administrateur de cet utilisateur !'], Response::HTTP_FORBIDDEN);
    }

    #[Route('/api/users', name: 'app_create_user', methods: ['POST'])]
    public function createUser(Request $request, EntityManagerInterface $entityManager, TagAwareCacheInterface $cache): JsonResponse
    {
        $user = new User();
        $user->setClient($this->getUser());

        $form = $this->createForm(UserType::class, $user);
        $form->submit($request->toArray());

        if ($form->isValid() === false) {
            return $this->json(['message' => 'Il y a une erreur, ou une valeur obligatoire oubliée, verifiez les données !'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        $cache->invalidateTags(["usersCache"]);

        return new JsonResponse(['message' => 'L\'utilisateur à bien été créé !'], Response::HTTP_CREATED);
    }
}
