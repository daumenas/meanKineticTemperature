<?php
namespace App\Domain\UserManagement\Model\Entity;
use App\Domain\FileManagement\Model\Entity\File;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="user_files")
 */
class UserFile {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private float $temperature;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private string $dateTime;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="App\Domain\UserManagement\Model\Entity\User",
     * )
     * @ORM\JoinColumn(
     *      name="user_id",
     *      referencedColumnName="id",
     *      onDelete="CASCADE",
     *      nullable=false
     * )
     */
    protected User $user;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="App\Domain\FileManagement\Model\Entity\File",
     *      inversedBy="UserFile"
     * )
     * @ORM\JoinColumn(
     *      name="file_id",
     *      referencedColumnName="id",
     *      onDelete="CASCADE",
     *      nullable=false
     * )
     */
    protected File $file;

//    public function __construct(
//        float $temperature,
//        \DateTime $dateTime,
//        User $user,
//        File $file
//    )
//    {
//        $this->temperature = $temperature;
//        $this->dateTime = $dateTime;
//        $this->user = $user;
//        $this->file = $file;
//    }

    public function updateValues
    (
        float $temperature,
        string $dateTime,
        User $user,
        File $file
    ) : void
    {
        $this->temperature = $temperature;
        $this->dateTime = $dateTime;
        $this->user = $user;
        $this->file = $file;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): void
    {
        $this->temperature = $temperature;
    }

    public function getDateTime(): string
    {
        return $this->dateTime;
    }

    public function setDateTime(string $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    public function setFile(File $file): void
    {
        $this->file = $file;
    }
}