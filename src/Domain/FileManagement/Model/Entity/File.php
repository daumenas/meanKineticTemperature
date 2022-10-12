<?php
namespace App\Domain\FileManagement\Model\Entity;
use App\Domain\UserManagement\Model\Entity\UserFile;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="files")
 */
class File {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private string $submitted;

    /**
     * @ORM\Column(type="float", length=100, nullable=true)
     */
    private ?float $meanKineticTemperature = null;

    /**
     * @ORM\OneToMany(
     *      targetEntity="App\Domain\UserManagement\Model\Entity\UserFile",
     *      mappedBy="file",
     *      cascade={"persist", "remove"}
     * )
     */
    protected Collection $userFile;

//    public function __construct($submitted)
//    {
//        $this->submitted = $submitted;
//
//        $this->userFile = new ArrayCollection();
//    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSubmitted(): string
    {
        return $this->submitted;
    }

    public function setSubmitted(string $submitted): void
    {
        $this->submitted = $submitted;
    }

    public function getMeanKineticTemperature(): ?float
    {
        return $this->meanKineticTemperature;
    }

    public function setMeanKineticTemperature(?float $meanKineticTemperature): void
    {
        $this->meanKineticTemperature = $meanKineticTemperature;
    }

    public function getUserFiles(): Collection
    {
        return $this->userFile;
    }

    public function addUserFile(UserFile $userFile): void
    {
        $this->userFile->add($userFile);
    }
}