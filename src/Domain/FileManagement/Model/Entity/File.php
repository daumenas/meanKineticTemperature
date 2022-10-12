<?php
namespace App\Entity;
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
     * @ORM\Column(type="datetime", length=100, nullable=false)
     */
    private \DateTime $submitted;

    /**
     * @ORM\Column(type="float", length=100, nullable=true)
     */
    private ?float $meanKineticTemperature;

    /**
     * @ORM\OneToMany(
     *      targetEntity="userFile",
     *      mappedBy="file",
     *      cascade={"persist", "remove"}
     * )
     */
    protected Collection $userFile;

    public function __construct
    (
        \DateTime $submitted
    )
    {
        $this->submitted = $submitted;

        $this->userFile = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSubmitted(): \DateTime
    {
        return $this->submitted;
    }

    public function getMeanKineticTemperature(): ?float
    {
        return $this->meanKineticTemperature;
    }

    public function setMeanKineticTemperature(float $meanKineticTemperature): void
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