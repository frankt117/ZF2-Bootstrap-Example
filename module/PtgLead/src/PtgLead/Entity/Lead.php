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
     * @ORM\OneToMany(targetEntity="PtgLead\Entity\Lead\EmailAddress", mappedBy="Lead")
     */
    protected $EmailAddresses;
    
    /**
     * @ORM\OneToOne(targetEntity="PtgLead\Entity\Lead\ContactLog", inversedBy="Lead", cascade={"persist", "remove"})
     */
    private $ContactLog;
    
    public function __construct() 
    {
        parent::__construct();
        
        $this->PhoneNumbers     = new ArrayCollection;
        $this->EmailAddresses   = new ArrayCollection;
        $this->Contacts         = new ArrayCollection;
        $this->ContactLog       = new \PtgLead\Entity\Lead\ContactLog();
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     * @return \PtgLead\Entity\Lead
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * @param \PtgLead\Entity\Lead\PhoneNumber $PhoneNumber
     */
    public function addPhoneNumber(Lead\PhoneNumber $PhoneNumber)
    {
        $PhoneNumber->setLead($this);
        
        $this->PhoneNumbers[] = $PhoneNumber;
        
        $PhoneNumber->setLead($this);
    }
    
    /**
     * @return ArrayCollection
     */
    public function getPhoneNumbers()
    {
        return $this->PhoneNumbers;
    }
    
    /**
     * @return ArrayCollection
     */
    public function getEmailAddresses()
    {
        return $this->EmailAddresses;
    }
    
    /**
     * @return Lead\ContactLog
     */
    public function getContactLog()
    {
        return $this->ContactLog;
    }
}
