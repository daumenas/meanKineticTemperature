<?php
namespace App\Entity;
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
     * @ORM\Column(type="datetime", length=100, nullable=false)
     */
    private \DateTime $dateTime;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="App\Entity\User",
     *      inversedBy="userFile"
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
     *      targetEntity="App\Entity\File",
     *      inversedBy="userFile"
     * )
     * @ORM\JoinColumn(
     *      name="file_id",
     *      referencedColumnName="id",
     *      onDelete="CASCADE",
     *      nullable=false
     * )
     */
    protected File $file;

    public function __construct(
        float $temperature,
        \DateTime $dateTime,
        User $user,
        File $file
    )
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

    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getFile(): File
    {
        return $this->file;
    }
}