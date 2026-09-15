<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Playlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $ispublic = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateC = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, Son>
     */
    #[ORM\ManyToMany(targetEntity: Son::class, mappedBy: 'playlists')]
    private Collection $sons;

    #[ORM\ManyToOne(inversedBy: 'playlists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function ispublic(): ?bool
    {
        return $this->ispublic;
    }

    public function setIspublic(bool $ispublic): static
    {
        $this->ispublic = $ispublic;

        return $this;
    }

    public function getDateC(): ?\DateTime
    {
        return $this->dateC;
    }

    public function setDateC(\DateTime $dateC): static
    {
        $this->dateC = $dateC;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

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
            $son->addPlaylist($this);
        }

        return $this;
    }

    public function removeSon(Son $son): static
    {
        if ($this->sons->removeElement($son)) {
            $son->removePlaylist($this);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

}
