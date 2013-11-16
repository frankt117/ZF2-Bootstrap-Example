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
     * @ORM\ManyToOne(targetEntity="PtgLead\Entity\Lead", inversedBy="PhoneNumbers")
     * @ORM\JoinColumn(name="ptglead_lead_id", referencedColumnName="id")
     */
    protected $Lead;
    
    public function setLead(\PtgLead\Entity\Lead $Lead)
    {
        $this->Lead = $Lead;
    }
}