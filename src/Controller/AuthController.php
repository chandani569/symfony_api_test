<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AuthController extends AbstractController
{
#[Route('/api/login', name: 'api_login', methods: ['POST'])]
public function login(Request $request, JWTTokenManagerInterface $jwtManager)
{
$user = $this->getUser();
return new JsonResponse(['token' => $jwtManager->create($user)]);
}
}
