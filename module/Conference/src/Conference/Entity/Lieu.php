<?php

namespace Conference\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* Lieu
* 
* @ORM\Table(name="lieu")
* @ORM\Entity(repositoryClass="Conference\Repository\LieuRepository")
*/

class Lieu 
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=40, nullable=false)
     */
    protected $nom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="capacite", type="string", length=40, nullable=false)
     */
    protected $capacite;
    
    
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Lieu
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
     * Set capacite
     *
     * @param string $capacite
     *
     * @return Lieu
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * Get capacite
     *
     * @return string
     */
    public function getCapacite()
    {
        return $this->capacite;
    }
}
