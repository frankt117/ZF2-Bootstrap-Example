<?php
namespace PtgLead\Entity\Lead;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity (repositoryClass="\PtgLead\Repository\Lead\WebRequest") 
 * @ORM\Table(name="ptglead_lead_webrequests") 
 * @PtgBase\Doctrine\DiscriminatorEntry(value="PtgLead\Entity\Lead\WebRequest")
 */
class WebRequest extends \PtgContact\Entity\Medium\WebRequest
{
    /**
     * @var \PtgLead\Entity\Lead
     * @ORM\ManyToOne(targetEntity="PtgLead\Entity\Lead", inversedBy="WebRequests")
     * @ORM\JoinColumn(name="ptglead_lead_id", referencedColumnName="id")
     */
    protected $Lead;
    
    /**
     * @param \PtgLead\Entity\Lead $Lead
     * @return \PtgLead\Entity\Lead\WebRequest
     */
    public function setLead(\PtgLead\Entity\Lead $Lead)
    {
        $this->Lead = $Lead;
        
        return $this;
    }
}