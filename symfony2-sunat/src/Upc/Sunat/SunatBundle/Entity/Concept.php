<?php

namespace Upc\Sunat\SunatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Concept
 *
 * @author herald olivares
 */
/**
 * Upc\Sunat\SunatBundle\Entity\Concept
 *
 * @ORM\Table(name="sunat_concept")
 * @ORM\Entity(repositoryClass="Upc\Sunat\SunatBundle\Repository\ConceptRepository")
 */
class Concept implements \Serializable {
    
    /**
     /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="name", type="string", length=150, nullable=false)
     */
    private $name;
    
    
    public function serialize() {
        return serialize(array(
            $this->id,
        ));
    }

    public function unserialize($serialized) {
        list (
            $this->id,
        ) = unserialize($serialized);
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
     * Set name
     *
     * @param string $name
     * @return Concept
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    public function __toString() {
        return $this->getName();
    }
}