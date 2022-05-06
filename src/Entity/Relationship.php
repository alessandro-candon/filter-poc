<?php

namespace App\Entity;

use App\Repository\RelationshipRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelationshipRepository::class)]
class Relationship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Test::class, inversedBy: 'relationships')]
    private $tests;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTests(): ?Test
    {
        return $this->tests;
    }

    public function setTests(?Test $tests): self
    {
        $this->tests = $tests;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Relationship
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
