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
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
