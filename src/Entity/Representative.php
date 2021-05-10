<?php

namespace App\Entity;

use App\Entity\Celebrity\Agent;
use App\Entity\Celebrity\Manager;
use App\Entity\Celebrity\Publicist;
use App\Repository\RepresentativeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RepresentativeRepository::class)
 */
class Representative
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company;

    /**
     * @Assert\Count(
     *      min = 1,
     *      minMessage = "You must specify at least one email"
     * )
     * @ORM\Column(type="simple_array")
     */
    private $emails = [];

    /**
     * @ORM\OneToMany(targetEntity=Agent::class, mappedBy="representative", orphanRemoval=true)
     */
    private $agentDuties;

    /**
     * @ORM\OneToMany(targetEntity=Publicist::class, mappedBy="representative", orphanRemoval=true)
     */
    private $publicistDuties;

    /**
     * @ORM\OneToMany(targetEntity=Manager::class, mappedBy="representative", orphanRemoval=true)
     */
    private $managerDuties;

    public function __construct()
    {
        $this->agentDuties = new ArrayCollection();
        $this->publicistDuties = new ArrayCollection();
        $this->managerDuties = new ArrayCollection();
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

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getEmails(): ?array
    {
        return $this->emails;
    }

    public function setEmails(array $emails): self
    {
        $this->emails = $emails;

        return $this;
    }

    /**
     * @return Collection|Agent[]
     */
    public function getAgentDuties(): Collection
    {
        return $this->agentDuties;
    }

    public function addAgentDuty(Agent $agentDuty): self
    {
        if (!$this->agentDuties->contains($agentDuty)) {
            $this->agentDuties[] = $agentDuty;
            $agentDuty->setRepresentative($this);
        }

        return $this;
    }

    public function removeAgentDuty(Agent $agentDuty): self
    {
        if ($this->agentDuties->removeElement($agentDuty)) {
            // set the owning side to null (unless already changed)
            if ($agentDuty->getRepresentative() === $this) {
                $agentDuty->setRepresentative(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Publicist[]
     */
    public function getPublicistDuties(): Collection
    {
        return $this->publicistDuties;
    }

    public function addPublicistDuty(Publicist $publicistDuty): self
    {
        if (!$this->publicistDuties->contains($publicistDuty)) {
            $this->publicistDuties[] = $publicistDuty;
            $publicistDuty->setRepresentative($this);
        }

        return $this;
    }

    public function removePublicistDuty(Publicist $publicistDuty): self
    {
        if ($this->publicistDuties->removeElement($publicistDuty)) {
            // set the owning side to null (unless already changed)
            if ($publicistDuty->getRepresentative() === $this) {
                $publicistDuty->setRepresentative(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Manager[]
     */
    public function getManagerDuties(): Collection
    {
        return $this->managerDuties;
    }

    public function addManagerDuty(Manager $managerDuty): self
    {
        if (!$this->managerDuties->contains($managerDuty)) {
            $this->managerDuties[] = $managerDuty;
            $managerDuty->setRepresentative($this);
        }

        return $this;
    }

    public function removeManagerDuty(Manager $managerDuty): self
    {
        if ($this->managerDuties->removeElement($managerDuty)) {
            // set the owning side to null (unless already changed)
            if ($managerDuty->getRepresentative() === $this) {
                $managerDuty->setRepresentative(null);
            }
        }

        return $this;
    }
}
