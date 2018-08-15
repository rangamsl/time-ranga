<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TimeRepository")
 */
class Time
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $projectnum;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $projectid;

    /**
     * @ORM\Column(type="integer")
     */
    private $typenum;

    /**
     * @ORM\Column(type="integer")
     */
    private $categorynum;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $day;

    /**
     * @ORM\Column(type="string", length=768, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=256, nullable=true)
     */
    private $timenotes;

    /**
     * @ORM\Column(type="integer")
     */
    private $hours;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minutes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gratishours;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gratisminutes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $invoicenum;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $paid;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $modified;

    public function getId()
    {
        return $this->id;
    }

    public function getProjectnum(): ?int
    {
        return $this->projectnum;
    }

    public function setProjectnum(?int $projectnum): self
    {
        $this->projectnum = $projectnum;

        return $this;
    }

    public function getProjectid(): ?string
    {
        return $this->projectid;
    }

    public function setProjectid(?string $projectid): self
    {
        $this->projectid = $projectid;

        return $this;
    }

    public function getTypenum(): ?int
    {
        return $this->typenum;
    }

    public function setTypenum(int $typenum): self
    {
        $this->typenum = $typenum;

        return $this;
    }

    public function getCategorynum(): ?int
    {
        return $this->categorynum;
    }

    public function setCategorynum(int $categorynum): self
    {
        $this->categorynum = $categorynum;

        return $this;
    }

    public function getDay(): ?\DateTimeInterface
    {
        return $this->day;
    }

    public function setDay(?\DateTimeInterface $day): self
    {
        $this->day = $day;

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

    public function getTimenotes(): ?string
    {
        return $this->timenotes;
    }

    public function setTimenotes(?string $timenotes): self
    {
        $this->timenotes = $timenotes;

        return $this;
    }

    public function getHours(): ?int
    {
        return $this->hours;
    }

    public function setHours(int $hours): self
    {
        $this->hours = $hours;

        return $this;
    }

    public function getMinutes(): ?int
    {
        return $this->minutes;
    }

    public function setMinutes(?int $minutes): self
    {
        $this->minutes = $minutes;

        return $this;
    }

    public function getGratishours(): ?int
    {
        return $this->gratishours;
    }

    public function setGratishours(?int $gratishours): self
    {
        $this->gratishours = $gratishours;

        return $this;
    }

    public function getGratisminutes(): ?int
    {
        return $this->gratisminutes;
    }

    public function setGratisminutes(?int $gratisminutes): self
    {
        $this->gratisminutes = $gratisminutes;

        return $this;
    }

    public function getInvoicenum(): ?int
    {
        return $this->invoicenum;
    }

    public function setInvoicenum(?int $invoicenum): self
    {
        $this->invoicenum = $invoicenum;

        return $this;
    }

    public function getPaid(): ?bool
    {
        return $this->paid;
    }

    public function setPaid(?bool $paid): self
    {
        $this->paid = $paid;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getModified(): ?\DateTimeInterface
    {
        return $this->modified;
    }

    public function setModified(?\DateTimeInterface $modified): self
    {
        $this->modified = $modified;

        return $this;
    }
}
