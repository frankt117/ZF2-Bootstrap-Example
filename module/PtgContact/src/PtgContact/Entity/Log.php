<?php
namespace PtgContact\Entity;

use Doctrine\ORM\Mapping as ORM,
    \Doctrine\Common\Collections\ArrayCollection;

/** 
 * @ORM\Entity (repositoryClass="\PtgContact\Repository\Log") 
 * @ORM\Table(name="ptgcontact_logs") 
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"ptgcontact_log" = "PtgContact\Entity\Log"})
 * @PtgBase\Doctrine\DiscriminatorEntry(value = "ptgcontact_log")
 */
abstract class Log extends \PtgBase\Doctrine\Entity
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer");
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="PtgContact\Entity\Contact")
     */
    protected $Contacts;
    
    public function __construct() 
    {
        parent::__construct();
        
        $this->Contacts = new ArrayCollection;
    }
    
    /**
     * @param \PtgContact\Entity\Contact $Contact
     * @return \PtgContact\Entity\Log
     */
    public function addContact(\PtgContact\Entity\Contact $Contact)
    {
        $this->Contacts[] = $Contact;
        
        return $this;
    }
    
    /**
     * @return ArrayCollection
     */
    public function getContacts()
    {
        return $this->Contacts;
    }
}
