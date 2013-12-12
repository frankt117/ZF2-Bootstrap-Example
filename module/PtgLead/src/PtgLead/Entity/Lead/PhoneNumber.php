<?php
namespace PtgLead\Entity\Lead;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity (repositoryClass="\PtgLead\Repository\Lead\PhoneNumber") 
 * @ORM\Table(name="ptglead_lead_phonenumbers") 
 * @PtgBase\Doctrine\DiscriminatorEntry(value="PtgLead\Entity\Lead\PhoneNumber")
 */
class PhoneNumber extends \PtgContact\Entity\Medium\PhoneNumber
{
    /**
     * @var \PtgLead\Entity\Lead
     * @ORM\ManyToOne(targetEntity="PtgLead\Entity\Lead", inversedBy="PhoneNumbers")
     * @ORM\JoinColumn(name="ptglead_lead_id", referencedColumnName="id")
     */
    protected $Lead;
    
    /**
     * @param \PtgLead\Entity\Lead $Lead
     * @return \PtgLead\Entity\Lead\PhoneNumber
     */
    public function setLead(\PtgLead\Entity\Lead $Lead)
    {
        $this->Lead = $Lead;
        
        return $this;
    }
}