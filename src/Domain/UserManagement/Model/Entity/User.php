<?php
namespace App\Domain\UserManagement\Model\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private string $ipAddress;

    /**
     * @ORM\OneToMany(
     *      targetEntity="UserFile",
     *      mappedBy="user",
     *      cascade={"persist", "remove"}
     * )
     */
    protected ?Collection $userFile;

//    public function __construct(string $ipAddress)
//    {
//        $this->ipAddress = $ipAddress;
//        $this->userFile = new ArrayCollection();
//    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    public function setIpAddress(string $ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }

    public function getUserFiles(): ?Collection
    {
        return $this->userFile;
    }
}