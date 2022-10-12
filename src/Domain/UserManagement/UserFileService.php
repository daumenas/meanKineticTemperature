<?php

namespace App\Service;

use App\Entity\User;
use App\Exceptions\InvalidFileException;
use App\Repository\UserFileRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserFileService
{
    private UserFileRepository $userFileRepository;
    private UserRepository $userRepository;

    public function __constructor(UserFileRepository $userFileRepository, UserRepository $userRepository)
    {
        $this->userFileRepository = $userFileRepository;
        $this->userRepository = $userRepository;
    }

    public function findAll(): Collection
    {
        return $this->userFileRepository->findAll();
    }

    /**
     * @throws InvalidFileException
     */
    public function uploadFile(Request $request, ValidatorInterface $validator): void
    {
        try {
            $user = $this->userRepository->findOneByIpOrFail($request->getClientIp());
        } catch (EntityNotFoundException $exception) {
            $user = new User($request->getClientIp());
            $this->userRepository->save($user);
        }

        $this->validateFile($validator, $request);
        $this->saveFileData($request, $user);
    }

    /**
     * @throws InvalidFileException
     */
    private function validateFile(ValidatorInterface $validator, Request $request): void
    {
        $fileValidationRules = [
            'mimeTypes' => ['csv'],
            'mimeTypesMessage' => 'Bad file type'
        ];

        $violationList = $validator->validate($request->files->get('file'), $fileValidationRules);

        if (count($violationList) > 0) {
            throw new InvalidFileException($violationList[0]);
        }
    }

    private function saveFileData(Request $request, User $user): void
    {
        $file = $request->files->get('file')->getData();

        while (($line = fgetcsv($file)) !== false) {
            dd($line);
            //$line is an array of the csv elements
            print_r($line);
        }
    }


}