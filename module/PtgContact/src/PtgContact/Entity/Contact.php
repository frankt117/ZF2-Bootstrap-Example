<?php
namespace PtgContact\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity (repositoryClass="\PtgContact\Repository\Contact") 
 * @ORM\Table(name="ptgcontact_contacts") 
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"ptgcontact_contact" = "PtgContact\Entity\Contact"})
 * @PtgBase\Doctrine\DiscriminatorEntry(value = "ptgcontact_contact")
 */
abstract class Contact extends \PtgBase\Doctrine\Entity
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer");
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=5000)
     */
    protected $message;
    
    /**
     * @ORM\Column(type="integer", length=1)
     */
    protected $requires_attention = 1;
    
    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
        
        return $this;
    }
    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * @param int|bool $bool
     */
    public function setRequiresAttention($bool)
    {
        $this->requires_attention = $bool ? 1 : 0;
    }
    
    /**
     * @return bool
     */
    public function requiresAttention()
    {
        return $this->requires_attention === 0 ? false : true;
    }
    
    /**
     * @return string
     */
    public function getRequiresAttentionString()
    {
        return $this->requires_attention === 0 ? "no" : "yes";
    }
}
