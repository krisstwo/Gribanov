<?php

namespace App\Entity;

use App\Repository\ChangeLogEntryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChangeLogEntryRepository::class)
 */
class ChangeLogEntry
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
    private $context;

    /**
     * @ORM\Column(type="integer")
     */
    private $identifier;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $moment;

    /**
     * @ORM\Column(type="json")
     */
    private $changeset = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $user;

    public function __construct()
    {
        $this->moment = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    public function setContext(string $context): self
    {
        $this->context = $context;

        return $this;
    }

    public function getIdentifier(): ?int
    {
        return $this->identifier;
    }

    public function setIdentifier(int $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getMoment(): ?\DateTimeImmutable
    {
        return $this->moment;
    }

    public function getChangeset(): ?array
    {
        return $this->changeset;
    }

    public function setChangeset(array $changeset): self
    {
        $this->changeset = $changeset;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(?string $user): self
    {
        $this->user = $user;

        return $this;
    }
}
