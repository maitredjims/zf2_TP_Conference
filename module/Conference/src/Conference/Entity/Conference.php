<?php

namespace Conference\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* Lieu
* 
* @ORM\Table(name="conference")
* @ORM\Entity
*/
class Conference 
{
    /**
     *
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /**
     *
     * @var datetime
     * 
     * @ORM\Column(name="date_debut", type="datetime", nullable=true)
     */
    protected $dateDebut;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=40, nullable=false)
     */
    protected $nom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="descriptif", type="string", length=255, nullable=false)
     */
    protected $descriptif;
    
    // Un lieu peut contenir plusieurs conférences donc le lien MANY dans conférence.
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Conference\Entity\Lieu", fetch="LAZY")
     */
    protected $lieu;

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

        /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Conference
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Conference
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set descriptif
     *
     * @param string $descriptif
     *
     * @return Conference
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * Set lieu
     *
     * @param \Conference\Entity\Lieu $lieu
     *
     * @return Conference
     */
    public function setLieu(\Conference\Entity\Lieu $lieu = null)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return \Conference\Entity\Lieu
     */
    public function getLieu()
    {
        return $this->lieu;
    }
}
