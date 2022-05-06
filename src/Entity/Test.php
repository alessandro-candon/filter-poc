<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestRepository::class)]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'tests', targetEntity: Relationship::class)]
    private $relationships;

    public function __construct()
    {
        $this->relationships = new ArrayCollection();
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

    /**
     * @return Collection<int, Relationship>
     */
    public function getRelationships(): Collection
    {
        return $this->relationships;
    }

    public function addRelationship(Relationship $relationship): self
    {
        if (!$this->relationships->contains($relationship)) {
            $this->relationships[] = $relationship;
            $relationship->setTests($this);
        }

        return $this;
    }

    public function removeRelationship(Relationship $relationship): self
    {
        if ($this->relationships->removeElement($relationship)) {
            // set the owning side to null (unless already changed)
            if ($relationship->getTests() === $this) {
                $relationship->setTests(null);
            }
        }

        return $this;
    }
}
