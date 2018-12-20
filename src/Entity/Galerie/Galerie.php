<?php

namespace App\Entity\Galerie;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Galerie\GalerieRepository")
 * @UniqueEntity(fields="slug", message="Une galerie d'image avec cette url existe déjà")
 * @ORM\HasLifecycleCallbacks
 */
class Galerie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="created", type="datetimetz")
     */
    private $created;

    /**
     * @ORM\Column(name="changed", type="datetimetz", nullable=true)
     */
    private $changed;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Compléter le champ titre")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=191, unique=true)
     * @Assert\NotBlank(message="Compléter le champ slug")
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contenu;
    
     /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Galerie\Categorie", inversedBy="galeries")
     */
    private $categories;

     /**
     * @ORM\OneToOne(targetEntity="App\Entity\Galerie\Image", cascade={"persist","remove"})
     * @Assert\Valid
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Galerie\Format", mappedBy="galerie", cascade={"persist","remove"})
     * @Assert\Valid
     */
    private $formats;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Galerie\Theme")
     */
    private $theme;

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->categories = new ArrayCollection();
        $this->formats = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $slugify = new Slugify();
        $this->slug = $slugify->slugify($slug);

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get the value of created
     */ 
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set the value of created
     *
     * @return  self
     */ 
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get the value of changed
     */ 
    public function getChanged()
    {
        return $this->changed;
    }

    /**
     * Set the value of changed
     *
     * @return  self
     */ 
    public function setChanged($changed)
    {
        $this->changed = $changed;

        return $this;
    }

     /**
     * @ORM\PreUpdate()
     */
    public function preChanged()
    {
        $this->changed = new \DateTime();
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Format[]
     */
    public function getFormats(): Collection
    {
        return $this->formats;
    }

    public function addFormat(Format $format): self
    {
        if (!$this->formats->contains($format)) {
            $this->formats[] = $format;
            $format->setGalerie($this);
        }

        return $this;
    }

    public function removeFormat(Format $format): self
    {
        if ($this->formats->contains($format)) {
            $this->formats->removeElement($format);
            // set the owning side to null (unless already changed)
            if ($format->getGalerie() === $this) {
                $format->setGalerie(null);
            }
        }

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

}
