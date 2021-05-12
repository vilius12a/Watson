<?php

namespace App\Entity;

use App\Repository\MeetingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MeetingRepository::class)
 */
class Meeting
{
    public const STATUS_CREATED = 1;
    public const STATUS_CANCELED = 2;
    public const STATUS_ENDED = 3;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="doctorMeetings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $doctor;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="patientMeetings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\ManyToMany(targetEntity=Procedure::class)
     */
    private $procedures;

    /**
     * @ORM\Column(type="integer", options={"default" = self::STATUS_CREATED})
     */
    private $status = self::STATUS_CREATED;

    public function __construct()
    {
        $this->procedures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDoctor(): ?User
    {
        return $this->doctor;
    }

    public function setDoctor(?User $doctor): self
    {
        $this->doctor = $doctor;

        return $this;
    }

    public function getPatient(): ?User
    {
        return $this->patient;
    }

    public function setPatient(?User $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * @return Collection|Procedure[]
     */
    public function getProcedures(): Collection
    {
        return $this->procedures;
    }

    public function addProcedure(Procedure $procedure): self
    {
        if (!$this->procedures->contains($procedure)) {
            $this->procedures[] = $procedure;
        }

        return $this;
    }

    public function removeProcedure(Procedure $procedure): self
    {
        $this->procedures->removeElement($procedure);

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
