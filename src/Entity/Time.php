<?php

// -------------------
// --- Time Entity ---
// -------------------

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Time
 *
 * @ORM\Table(name="time")
 * @ORM\Entity
 */
class Time
{
    public function __construct() {
        // set created and modified
        $this->setCreated(new \DateTime());
        if ($this->getModified() == null) {
            $this->setModified(new \DateTime());
        }
    }

    /** @ORM\PrePersist()
     * @ORM\PreUpdate() */
    public function updateModifiedDatetime() {
        // update the modified time
        $this->setModified(new \DateTime());
    }


    // ------------------------------
    // --- DB Mapping Annotations ---
    // ------------------------------

    /** @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY") */
    private $id;

    /** @var integer
     * @ORM\Column(name="categoryid", type="integer", length=11, nullable=true) */
    private $categoryid;

    /** @var string
     * @ORM\Column(name="categorycode", type="string", length=8, nullable=true) */
    private $categorycode;

    /** @var integer
     * @ORM\Column(name="projectid", type="integer", length=11, nullable=true) */
    private $projectid;

    /** @var string
     * @ORM\Column(name="projectcode", type="string", length=8, nullable=true) */
    private $projectcode;

    /** @var integer
     * @ORM\Column(name="targetid", type="integer", length=11, nullable=true) */
    private $targetid;

    /** @var string
     * @ORM\Column(name="targetcode", type="string", length=8, nullable=true) */
    private $targetcode;

    /** @var string
     * @ORM\Column(name="type", type="string", length=1, nullable=true) */
    private $type;

    /** @var string
     * @ORM\Column(name="groups", type="string", length=32, nullable=true) */
    private $group;

    /** @var \DateTime
     * @ORM\Column(name="day", type="datetime", nullable=true) */
    private $day;

    /** @var boolean
     * @ORM\Column(name="internal", type="boolean", length=1, nullable=true) */
    private $internal;

    /** @var string
     * @ORM\Column(name="description", type="string", length=768, nullable=true) */
    private $description;

    /** @var string
     * @ORM\Column(name="timenotes", type="string", length=256, nullable=true) */
    private $timenotes;

    /** @var integer
     * @ORM\Column(name="hours", type="integer", length=8, nullable=true) */
    private $hours;

    /** @var integer
     * @ORM\Column(name="minutes", type="smallint", length=2, nullable=true) */
    private $minutes;

    /** @var integer
     * @ORM\Column(name="gratishours", type="integer", length=8, nullable=true) */
    private $gratishours;

    /** @var integer
     * @ORM\Column(name="gratisminutes", type="smallint", length=2, nullable=true) */
    private $gratisminutes;

    /** @var boolean
     * @ORM\Column(name="temp", type="boolean", length=1, nullable=true) */
    private $temp;

    /** @var string
     * @ORM\Column(name="malformed", type="string", length=1024, nullable=true) */
    private $malformed;

    /** @var integer
     * @ORM\Column(name="invoicenum", type="integer", length=11, nullable=true) */
    private $invoicenum;

    /** @var boolean
     * @ORM\Column(name="paid", type="boolean", length=1, nullable=true) */
    private $paid;

    /** @var string
     * @ORM\Column(name="labels", type="string", length=128, nullable=true) */
    private $labels;

    /** @var \DateTime
     * @ORM\Column(name="created", type="datetime", nullable=true) */
    private $created;

    /** @var \DateTime
     * @ORM\Column(name="modified", type="datetime", nullable=true) */
    private $modified;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     * @ORM\JoinColumn()
     */
    private $user;


    // -------------------------------
    // --- Getter & Setter Methods ---
    // -------------------------------

    // -- id --
    public function getId(): ?int {return $this->id;}

    // -- projectid --
    public function getProjectid(): ?int {return $this->projectid;}
    public function setProjectid(int $projectid): self {$this->projectid = $projectid; return $this;}

    // -- projectcode --
    public function getProjectcode(): ?string {return $this->projectcode;}
    public function setProjectcode(?string $projectcode): self {$this->projectcode = $projectcode; return $this;}

    // -- day --
    public function getDay(): ?\DateTimeInterface {return $this->day;}
    public function setDay(\DateTimeInterface $day): self {$this->day = $day; return $this;}

    // -- description --
    public function getDescription(): ?string {return $this->description;}
    public function setDescription(string $description): self {$this->description = $description; return $this;}

    // -- timenotes --
    public function getTimenotes(): ?string {return $this->timenotes;}
    public function setTimenotes(string $timenotes): self {$this->timenotes = $timenotes; return $this;}

    // -- hours --
    public function getHours(): ?int {return $this->hours;}
    public function setHours(int $hours): self {$this->hours = $hours; return $this;}

    // -- minutes --
    public function getMinutes(): ?int {return $this->minutes;}
    public function setMinutes(int $minutes): self {$this->minutes = $minutes; return $this;}

    // -- temp --
    public function getTemp(): ?bool {return $this->temp;}
    public function setTemp(int $temp): self {$this->temp = $temp; return $this;}

    // -- malformed --
    public function getMalformed(): ?string {return $this->malformed;}
    public function setMalformed(string $malformed): self {$this->malformed = $malformed; return $this;}

    // -- created --
    public function getCreated(): ?\DateTime {return $this->created;}
    public function setCreated(\DateTime $created): self {$this->created = $created; return $this;}

    // -- modified --
    public function getModified(): ?\DateTime {return $this->modified;}
    public function setModified(\DateTime $modified): self {$this->modified = $modified; return $this;}

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }


}
