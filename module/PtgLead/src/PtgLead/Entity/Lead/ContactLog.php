<?php
namespace PtgLead\Entity\Lead;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity (repositoryClass="\PtgLead\Entity\Lead\ContactLog") 
 * @ORM\Table(name="ptglead_lead_contactlogs") 
 * @PtgBase\Doctrine\DiscriminatorEntry(value="PtgLead\Entity\Lead\ContactLog")
 */
class ContactLog extends \PtgContact\Entity\Log
{
    /**
     * @ORM\OneToOne(targetEntity="PtgLead\Entity\Lead", mappedBy="ContactLog")
     **/
    protected $Lead;
    
    /**
     * @param \PtgLead\Entity\Lead $Lead
     * @return \PtgLead\Entity\Lead\ContactLog
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