<?php
namespace PtgLead\Entity\Lead;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity (repositoryClass="\PtgLead\Repository\Lead\EmailAddress") 
 * @ORM\Table(name="ptglead_lead_emailaddresses") 
 * @PtgBase\Doctrine\DiscriminatorEntry(value="PtgLead\Entity\Lead\EmailAddress")
 */
class EmailAddress extends \PtgContact\Entity\Medium\EmailAddress
{
    /**
     * @var \PtgLead\Entity\Lead
     * @ORM\ManyToOne(targetEntity="PtgLead\Entity\Lead", inversedBy="EmailAddresses")
     * @ORM\JoinColumn(name="ptglead_lead_id", referencedColumnName="id")
     */
    protected $Lead;
    
    /**
     * @param \PtgLead\Entity\Lead $Lead
     * @return \PtgLead\Entity\Lead\EmailAddress
     */
    public function setLead(\PtgLead\Entity\Lead $Lead)
    {
        $this->Lead = $Lead;
        
        return $this;
    }
    
    /**
     * @return \PtgLead\Entity\Lead
     */
    public function getLead()
    {
        return $this->Lead;
    }
}