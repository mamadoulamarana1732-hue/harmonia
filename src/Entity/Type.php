<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created = null;

    /**
     * @var Collection<int, Son>
     */
    #[ORM\ManyToMany(targetEntity: Son::class, mappedBy: 'types')]
    private Collection $sons;

    public function __construct()
    {
        $this->sons = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getCreated(): ?\DateTimeImmutable
    {
        return $this->created;
    }

    public function setCreated(\DateTimeImmutable $created): static
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return Collection<int, Son>
     */
    public function getSons(): Collection
    {
        return $this->sons;
    }

    public function addSon(Son $son): static
    {
        if (!$this->sons->contains($son)) {
            $this->sons->add($son);
            $son->addType($this);
        }

        return $this;
    }

    public function removeSon(Son $son): static
    {
        if ($this->sons->removeElement($son)) {
            $son->removeType($this);
        }

        return $this;
    }


}
