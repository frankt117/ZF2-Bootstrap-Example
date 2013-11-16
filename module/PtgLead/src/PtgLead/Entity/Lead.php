<?php
namespace PtgLead\Entity;

use Doctrine\ORM\Mapping as ORM,
 \Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity
* @ORM\Table(name="ptglead_leads")
*/
class Lead extends \PtgBase\Doctrine\Entity 
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer");
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
    * @ORM\Column(type="string")
    */
    protected $name;
    
    /**
     * @ORM\OneToMany(targetEntity="PtgLead\Entity\Lead\PhoneNumber", mappedBy="Lead")
     */
    protected $PhoneNumbers;
    
    /**
     * @ORM\OneToMany(targetEntity="PtgLead\Entity\Lead\Request", mappedBy="Lead")
     */
    protected $Requests;
    
    public function __construct() 
    {
        parent::__construct();
        
        $this->PhoneNumbers = new ArrayCollection;
        $this->Requests     = new ArrayCollection;
    }
    
    public function addPhoneNumber(Lead\PhoneNumber $PhoneNumber)
    {
        $this->PhoneNumbers[] = $PhoneNumber;
        
        $PhoneNumber->setLead($this);
    }
}
