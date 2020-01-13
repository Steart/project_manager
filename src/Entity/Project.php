<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"persist", "remove"})
     */
    private $address;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVisible;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProjectHoursBookings", mappedBy="project", orphanRemoval=true)
     */
    private $hoursBookings;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contact", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contact;

    public function __construct()
    {
        $this->hoursBookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getIsVisible(): ?bool
    {
        return $this->isVisible;
    }

    public function setIsVisible(bool $isVisible): self
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    /**
     * @return Collection|ProjectHoursBookings[]
     */
    public function getHoursBookings(): Collection
    {
        return $this->hoursBookings;
    }

    public function addProject(ProjectHoursBookings $project): self
    {
        if (!$this->hoursBookings->contains($project)) {
            $this->hoursBookings[] = $project;
            $project->setProject($this);
        }

        return $this;
    }

    public function removeProject(ProjectHoursBookings $project): self
    {
        if ($this->hoursBookings->contains($project)) {
            $this->hoursBookings->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getProject() === $this) {
                $project->setProject(null);
            }
        }

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }
}
