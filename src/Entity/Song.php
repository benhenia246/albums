<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SongRepository")
 */
class Song
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $songTitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $songDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $songLink;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Album", inversedBy="songs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $album;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSongTitle(): ?string
    {
        return $this->songTitle;
    }

    public function setSongTitle(string $songTitle): self
    {
        $this->songTitle = $songTitle;

        return $this;
    }

    public function getSongDescription(): ?string
    {
        return $this->songDescription;
    }

    public function setSongDescription(?string $songDescription): self
    {
        $this->songDescription = $songDescription;

        return $this;
    }

    public function getSongLink(): ?string
    {
        return $this->songLink;
    }

    public function setSongLink(?string $songLink): self
    {
        $this->songLink = $songLink;

        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): self
    {
        $this->album = $album;

        return $this;
    }
}
