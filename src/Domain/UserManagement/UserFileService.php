<?php

namespace App\Domain\UserManagement;

use App\Domain\FileManagement\Model\Entity\File;
use App\Domain\FileManagement\Model\Exceptions\InvalidFileException;
use App\Domain\FileManagement\Model\Storage\Repository\FileRepository;
use App\Domain\UserManagement\Model\Entity\User;
use App\Domain\UserManagement\Model\Entity\UserFile;
use App\Domain\UserManagement\Model\Enum\MeanKineticEnergyEnum;
use App\Domain\UserManagement\Model\Exceptions\FileContainsBadDataException;
use App\Domain\UserManagement\Model\Storage\Repository\UserFileRepository;
use App\Domain\UserManagement\Model\Storage\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserFileService
{
    /** @required */
    public UserFileRepository $userFileRepository;
    /** @required */
    public UserRepository $userRepository;
    /** @required */
    public FileRepository $fileRepository;

    public function __constructor(
        UserFileRepository $userFileRepository,
        UserRepository $userRepository,
        FileRepository $fileRepository
    )
    {
        $this->userFileRepository = $userFileRepository;
        $this->userRepository = $userRepository;
        $this->fileRepository = $fileRepository;
    }

    public function findAll(): Collection
    {
        return $this->userFileRepository->findAll();
    }

    /**
     * @throws InvalidFileException
     * @throws FileContainsBadDataException
     */
    public function uploadFile(Request $request): void
    {
        try {
            $user = $this->userRepository->findOneByIpOrFail($request->getClientIp());
        } catch (EntityNotFoundException $exception) {
            $user = new User();
            $user->setIpAddress($request->getClientIp());
            $this->userRepository->save($user);
        }
        $file = new File();
        $file->setSubmitted(date('Y-m-d'));
        $this->fileRepository->save($file);

        $this->validateFile($request);
        $this->saveFileData($request, $user, $file);
    }

    /**
     * @throws InvalidFileException
     */
    private function validateFile(Request $request): void
    {
        $allowedTypes = [
            'text/csv'
        ];

        if(!$request->files->get('fileName')) {
            throw new InvalidFileException('File undefined');
        }
        if (!in_array($request->files->get('fileName')->getClientmimeType(), $allowedTypes)) {
            throw new InvalidFileException('Incorrect file type. Only accepts .csv files');
        }
    }

    /**
     * @throws FileContainsBadDataException
     */
    private function saveFileData(Request $request, User $user, File $file): void
    {
        $newFile = $request->files->get('fileName')->getPathname();
        $fullFile = file_get_contents($newFile);
        $lines = explode("\n", $fullFile);
        $temperatureArray = [];
        foreach ($lines as $oneLine) {
            $split = explode(",", $oneLine);
            if (isset($split[2])) {
                $userFile = new UserFile();
                $userFile->updateValues(
                    (float)$split[2],
                    $split[0] . ' ' . $split[1],
                    $user,
                    $file
                );
                $this->userFileRepository->save($userFile);
                $temperatureArray[] = (float)$split[2];
            } else if (count($split) < 1) {
                throw new FileContainsBadDataException();
            }
        }
        $file->setMeanKineticTemperature($this->calculateMeanKineticTemperature($temperatureArray));
        $this->fileRepository->save($file);
    }

    private function calculateMeanKineticTemperature(array $temperatureArray): float
    {
        $meanKineticEnergy = 0;

        foreach ($temperatureArray as $temperature) {
            $kelvin = (float)$temperature + MeanKineticEnergyEnum::KELVIN;
            $readingResult = exp(MeanKineticEnergyEnum::DELTA_H / (MeanKineticEnergyEnum::GAS * $kelvin));
            $meanKineticEnergy += $readingResult;
        }
        $meanKineticEnergy = $meanKineticEnergy / count($temperatureArray);
        $meanKineticEnergy = log($meanKineticEnergy);
        $meanKineticEnergy = (MeanKineticEnergyEnum::DELTA_H / MeanKineticEnergyEnum::GAS) / $meanKineticEnergy;

        return $meanKineticEnergy - MeanKineticEnergyEnum::KELVIN;
    }
}