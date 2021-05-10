<?php

namespace App\Entity;

use App\Entity\Celebrity\Agent;
use App\Entity\Celebrity\Manager;
use App\Entity\Celebrity\Publicist;
use App\Repository\CelebrityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CelebrityRepository::class)
 */
class Celebrity
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
     * @ORM\Column(type="date_immutable")
     */
    private $birthday;

    /**
     * @ORM\Column(type="text")
     */
    private $bio;

    /**
     * @ORM\OneToMany(targetEntity=Agent::class, mappedBy="celebrity", cascade={"all"}, orphanRemoval=true)
     */
    private $agents;

    /**
     * @ORM\OneToMany(targetEntity=Publicist::class, mappedBy="celebrity", cascade={"all"}, orphanRemoval=true)
     */
    private $publicists;

    /**
     * @ORM\OneToMany(targetEntity=Manager::class, mappedBy="celebrity", cascade={"all"}, orphanRemoval=true)
     */
    private $managers;

    public function __construct()
    {
        $this->agents = new ArrayCollection();
        $this->publicists = new ArrayCollection();
        $this->managers = new ArrayCollection();
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

    public function getBirthday(): ?\DateTimeImmutable
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeImmutable $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * @return Collection|Agent[]
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agent $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
            $agent->setCelebrity($this);
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        if ($this->agents->removeElement($agent)) {
            // set the owning side to null (unless already changed)
            if ($agent->getCelebrity() === $this) {
                $agent->setCelebrity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Publicist[]
     */
    public function getPublicists(): Collection
    {
        return $this->publicists;
    }

    public function addPublicist(Publicist $publicist): self
    {
        if (!$this->publicists->contains($publicist)) {
            $this->publicists[] = $publicist;
            $publicist->setCelebrity($this);
        }

        return $this;
    }

    public function removePublicist(Publicist $publicist): self
    {
        if ($this->publicists->removeElement($publicist)) {
            // set the owning side to null (unless already changed)
            if ($publicist->getCelebrity() === $this) {
                $publicist->setCelebrity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Manager[]
     */
    public function getManagers(): Collection
    {
        return $this->managers;
    }

    public function addManager(Manager $manager): self
    {
        if (!$this->managers->contains($manager)) {
            $this->managers[] = $manager;
            $manager->setCelebrity($this);
        }

        return $this;
    }

    public function removeManager(Manager $manager): self
    {
        if ($this->managers->removeElement($manager)) {
            // set the owning side to null (unless already changed)
            if ($manager->getCelebrity() === $this) {
                $manager->setCelebrity(null);
            }
        }

        return $this;
    }
}
