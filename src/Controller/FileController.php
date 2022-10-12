<?php
namespace App\Controller;

use App\Domain\FileManagement\Model\Exceptions\InvalidFileException;
use App\Domain\UserManagement\Model\Exceptions\FileContainsBadDataException;
use App\Domain\UserManagement\UserFileService;
use App\Domain\UserManagement\UserService;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/file")
 */
class FileController extends AbstractController
{
    /** @required */
    public UserService $userService;
    /** @required */
    public UserFileService $userFileService;

    public function __construct
    (
        UserService $userService,
        UserFileService $userFileService
    )
    {
        $this->userService = $userService;
        $this->userFileService = $userFileService;
    }
    /**
     * @Route("/upload", name="api_file_upload", methods="POST")
     */
    public function fileUpload(Request $request): JsonResponse
    {
        try {
            $this->userFileService->uploadFile($request);
        } catch (InvalidFileException|FileContainsBadDataException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse();
    }
}