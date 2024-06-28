<?php
/**
 * User controller.
 */


namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * Class UserController.
 */
class UserController extends AbstractController
{
    /**
     * List of users.
     *
     * @param UserRepository $userRepository User repository
     * @param UserInterface  $user           Current user
     */
    #[Route('/users', name: 'user_list', methods: ['GET'])]
    #[IsGranted('LIST', subject: 'user')]
    public function list(UserRepository $userRepository, UserInterface $user): Response
    {
        // Fetch all users
        $users = $userRepository->findAll();

        // Render the template
        return $this->render('user/list.html.twig', [
            'users' => $users,
        ]);
    }
}
