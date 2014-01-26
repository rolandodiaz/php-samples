<?php

namespace Upc\Sunat\SunatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Person
 *
 * @author herald olivares
 */
/**
 * Upc\Sunat\SunatBundle\Entity\Person
 *
 * @ORM\Table(name="sunat_person")
 * @ORM\Entity(repositoryClass="Upc\Sunat\SunatBundle\Repository\PersonRepository")
 */
class Person implements \Serializable {
    
    public static $TYPES = array(
        1 => 'Persona Juridica',
        2 => 'Persona Natural'
    );

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
    
    /**
     * @ORM\Column(name="ruc", type="string", length=11, nullable=false)
     */
    private $ruc;
    
    /**
     * @ORM\Column(name="phone", type="string", length=10, nullable=true)
     */
    private $phone;
    
    /**
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type;
    
    public function displaytype(){
        return Person::$TYPES[$this->type];
    }
    
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
     * @return Person
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

    /**
     * Set ruc
     *
     * @param string $ruc
     * @return Person
     */
    public function setRuc($ruc)
    {
        $this->ruc = $ruc;
    
        return $this;
    }

    /**
     * Get ruc
     *
     * @return string 
     */
    public function getRuc()
    {
        return $this->ruc;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Person
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Person
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }
    
    public function __toString() {
        return $this->getRuc();
    }
}