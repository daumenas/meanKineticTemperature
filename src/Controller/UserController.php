<?php
namespace App\Controller;

use App\Domain\UserManagement\UserService;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Contracts\Service\Attribute\Required;

class UserController extends AbstractController
{
    /** @required */
    public UserService $userService;

    public function __construct
    (
        UserService $userService
    )
    {
        $this->userService = $userService;
    }
    /**
     * @Route("/", name="user_list", methods="GET")
     */
    public function index(Request $request): Response
    {
        $userIp = $request->getClientIp();
        try {
            $user = $this->userService->findOneByIp($userIp);
        } catch (EntityNotFoundException $exception) {
            return $this->render('user/index.html.twig');
        }
        return $this->render('user/user_upload.html.twig',
        [
            'user' => $user,
            'user_files' => $user->getUserFiles(),
        ]);
    }
}