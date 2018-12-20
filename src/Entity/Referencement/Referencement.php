<?php

namespace App\Entity\Referencement;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use App\Utilities\Upload;

/**
 * Referencement
 *
 * @ORM\Table(name="referencement")
 * @ORM\Entity(repositoryClass="App\Repository\Referencement\ReferencementRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Referencement
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(message="Compléter le champ Meta title")
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\NotBlank(message="Compléter le champ Meta description")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="ogtitle", type="string", length=255, nullable=true)
     */
    private $ogtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="ogdescription", type="string", length=255, nullable=true)
     */
    private $ogdescription;

    /**
     * @var string
     *
     * @ORM\Column(name="ogurl", type="string", length=255, nullable=true)
     */
    private $ogurl;

    /**
     * @Assert\Image(
        minWidth = 300,
        minHeight = 300,
        mimeTypes = {"image/jpeg", "image/png"}),
        maxSize = "2M"
     */
    private $fileogimage;

    /**
     * @var string
     *
     * @ORM\Column(name="ogimage", type="string", length=255, nullable=true)
     */
    private $ogimage;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Referencement
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set changed
     *
     * @param \DateTime $changed
     *
     * @return Referencement
     */
    public function setChanged($changed)
    {
        $this->changed = $changed;

        return $this;
    }

    /**
     * Get changed
     *
     * @return \DateTime
     */
    public function getChanged()
    {
        return $this->changed;
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preChanged()
    {
        $this->changed = new \DateTime();
    }

    /**
     * Set ogtitle
     *
     * @param string $ogtitle
     *
     * @return Referencement
     */
    public function setOgtitle($ogtitle)
    {
        $this->ogtitle = $ogtitle;

        return $this;
    }

    /**
     * Get ogtitle
     *
     * @return string
     */
    public function getOgtitle()
    {
        return $this->ogtitle;
    }

    /**
     * Set ogdescription
     *
     * @param string $ogdescription
     *
     * @return Referencement
     */
    public function setOgdescription($ogdescription)
    {
        $this->ogdescription = $ogdescription;

        return $this;
    }

    /**
     * Get ogdescription
     *
     * @return string
     */
    public function getOgdescription()
    {
        return $this->ogdescription;
    }

    /**
     * Set ogurl
     *
     * @param string $ogurl
     *
     * @return Referencement
     */
    public function setOgurl($ogurl)
    {
        $this->ogurl = $ogurl;

        return $this;
    }

    /**
     * Get ogurl
     *
     * @return string
     */
    public function getOgurl()
    {
        return $this->ogurl;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Referencement
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Referencement
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set ogimage
     *
     * @param string $ogimage
     *
     * @return Actualite
     */
    public function setOgimage($ogimage)
    {
        $this->ogimage = $ogimage;

        return $this;
    }

    /**
     * Get ogimage
     *
     * @return string
     */
    public function getOgimage()
    {
        return $this->ogimage;
    }

    public function getFileogimage()
    {
        return $this->fileogimage;
    }

    public function setFileogimage(UploadedFile $fileogimage = null)
    {
        $this->fileogimage = $fileogimage;
        if (null !== $this->ogimage){
            $this->ogimage = null;
        }
    }

    public function uploadOgimage()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->fileogimage) {
            return;
        }

        $upload = new Upload();
        $this->ogimage = $upload->createName(
            $this->fileogimage->getClientOriginalName(),
            $this->getUploadRootDir().'/',
            array('og')
        );

        /* Miniature */
        $imagine = new Imagine();
        $size = new Box(200,200);
        $imagine->open($this->fileogimage)
            ->thumbnail($size, 'outbound')
            ->save($this->getUploadRootDir().'og/'.$this->ogimage);

    }

    public function getUploadRootDir()
    {
        return __DIR__.'/../../../public/img/referencement/';
    }
}
