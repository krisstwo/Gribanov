<?php

namespace App\Entity\Celebrity;

use App\Entity\Celebrity;
use App\Entity\Representative;
use App\Repository\Celebrity\AgentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgentRepository::class)
 */
class Agent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Representative::class, inversedBy="agentDuties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $representative;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $territory;

    /**
     * @ORM\ManyToOne(targetEntity=Celebrity::class, inversedBy="agents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $celebrity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRepresentative(): ?Representative
    {
        return $this->representative;
    }

    public function setRepresentative(?Representative $representative): self
    {
        $this->representative = $representative;

        return $this;
    }

    public function getTerritory(): ?string
    {
        return $this->territory;
    }

    public function setTerritory(?string $territory): self
    {
        $this->territory = $territory;

        return $this;
    }

    public function getCelebrity(): ?Celebrity
    {
        return $this->celebrity;
    }

    public function setCelebrity(?Celebrity $celebrity): self
    {
        $this->celebrity = $celebrity;

        return $this;
    }
}
