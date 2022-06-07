<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'date')]
    private $datePub;

    #[ORM\Column(type: 'string', length: 255)]
    private $path;

    #[ORM\ManyToMany(targetEntity: Adherent::class, inversedBy: 'documents')]
    private $adherent;

    #[ORM\ManyToOne(targetEntity: Domain::class, inversedBy: 'documents')]
    private $domain;

    #[ORM\ManyToOne(targetEntity: Account::class, inversedBy: 'documents')]
    private $account;

    #[ORM\OneToMany(mappedBy: 'document', targetEntity: Media::class)]
    private $media;

    #[ORM\OneToMany(mappedBy: 'document', targetEntity: Like::class)]
    private $like_doc;

    #[ORM\OneToOne(targetEntity: Project::class, cascade: ['persist', 'remove'])]
    private $project;

    public function __construct()
    {
        $this->adherent = new ArrayCollection();
        $this->media = new ArrayCollection();
        $this->like_doc = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getDatePub(): ?\DateTimeInterface
    {
        return $this->datePub;
    }

    public function setDatePub(\DateTimeInterface $datePub): self
    {
        $this->datePub = $datePub;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return Collection<int, Adherent>
     */
    public function getAdherent(): Collection
    {
        return $this->adherent;
    }

    public function addAdherent(Adherent $adherent): self
    {
        if (!$this->adherent->contains($adherent)) {
            $this->adherent[] = $adherent;
        }

        return $this;
    }

    public function removeAdherent(Adherent $adherent): self
    {
        $this->adherent->removeElement($adherent);

        return $this;
    }

    public function getDomain(): ?Domain
    {
        return $this->domain;
    }

    public function setDomain(?Domain $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
            $medium->setDocument($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getDocument() === $this) {
                $medium->setDocument(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Like>
     */
    public function getLikeDoc(): Collection
    {
        return $this->like_doc;
    }

    public function addLikeDoc(Like $likeDoc): self
    {
        if (!$this->like_doc->contains($likeDoc)) {
            $this->like_doc[] = $likeDoc;
            $likeDoc->setDocument($this);
        }

        return $this;
    }

    public function removeLikeDoc(Like $likeDoc): self
    {
        if ($this->like_doc->removeElement($likeDoc)) {
            // set the owning side to null (unless already changed)
            if ($likeDoc->getDocument() === $this) {
                $likeDoc->setDocument(null);
            }
        }

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
