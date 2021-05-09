<?php

namespace App\Entity;

use App\Repository\MeetingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MeetingRepository::class)
 */
class Meeting
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $patient_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $doctor_id;

    /**
     * @ORM\ManyToOne(targetEntity=procedure::class, inversedBy="meetings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $procedure_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPatientId(): ?int
    {
        return $this->patient_id;
    }

    public function setPatientId(int $patient_id): self
    {
        $this->patient_id = $patient_id;

        return $this;
    }

    public function getDoctorId(): ?int
    {
        return $this->doctor_id;
    }

    public function setDoctorId(int $doctor_id): self
    {
        $this->doctor_id = $doctor_id;

        return $this;
    }

    public function getProcedureId(): ?procedure
    {
        return $this->procedure_id;
    }

    public function setProcedureId(?procedure $procedure_id): self
    {
        $this->procedure_id = $procedure_id;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
