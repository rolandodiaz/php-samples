<?php

namespace Upc\Sunat\SunatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Debt
 *
 * @author herald olivares
 */
/**
 * Upc\Sunat\SunatBundle\Entity\Debt
 *
 * @ORM\Table(name="sunat_debt")
 * @ORM\Entity(repositoryClass="Upc\Sunat\SunatBundle\Repository\DebtRepository")
 */
class Debt implements \Serializable {
    
    /**
     /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Concept")
     * @ORM\JoinColumn(name="concept_id", referencedColumnName="id")
     */    
    private $concept;
    
    /**
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */    
    private $person;
    
    /**
     * @ORM\Column(name="period", type="string", length=50, nullable=false)
     */
    private $period;
    
    /**
     * @ORM\Column(name="resolution_number", type="string", length=10, nullable=true)
     */
    private $resolutionNumber;
    
    /**
     * @ORM\Column(name="tax_code", type="string", length=10, nullable=true)
     */
    private $taxCode;
    
    /**
     * @ORM\Column(name="amount", type="decimal", nullable=false, precision=14, scale=4)
     */
    private $amount;
    
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
     * Set period
     *
     * @param string $period
     * @return Debt
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    
        return $this;
    }

    /**
     * Get period
     *
     * @return string 
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set resolution_number
     *
     * @param string $resolutionNumber
     * @return Debt
     */
    public function setResolutionNumber($resolutionNumber)
    {
        $this->resolutionNumber = $resolutionNumber;
    
        return $this;
    }

    /**
     * Get resolution_number
     *
     * @return string 
     */
    public function getResolutionNumber()
    {
        return $this->resolutionNumber;
    }

    /**
     * Set tax_code
     *
     * @param string $taxCode
     * @return Debt
     */
    public function setTaxCode($taxCode)
    {
        $this->taxCode = $taxCode;
    
        return $this;
    }

    /**
     * Get tax_code
     *
     * @return string 
     */
    public function getTaxCode()
    {
        return $this->taxCode;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return Debt
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    
        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set concept
     *
     * @param \Upc\Sunat\SunatBundle\Entity\Concept $concept
     * @return Debt
     */
    public function setConcept(\Upc\Sunat\SunatBundle\Entity\Concept $concept = null)
    {
        $this->concept = $concept;
    
        return $this;
    }

    /**
     * Get concept
     *
     * @return \Upc\Sunat\SunatBundle\Entity\Concept 
     */
    public function getConcept()
    {
        return $this->concept;
    }

    /**
     * Set person
     *
     * @param \Upc\Sunat\SunatBundle\Entity\Person $person
     * @return Debt
     */
    public function setPerson(\Upc\Sunat\SunatBundle\Entity\Person $person = null)
    {
        $this->person = $person;
    
        return $this;
    }

    /**
     * Get person
     *
     * @return \Upc\Sunat\SunatBundle\Entity\Person 
     */
    public function getPerson()
    {
        return $this->person;
    }
}