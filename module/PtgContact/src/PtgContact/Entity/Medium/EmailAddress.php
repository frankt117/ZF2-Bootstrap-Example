<?php
namespace PtgContact\Entity\Medium;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity (repositoryClass="\PtgContact\Repository\Medium\EmailAddress") 
 * @ORM\Table(name="ptgcontact_medium_emailaddresses") 
 * @PtgBase\Doctrine\DiscriminatorEntry(value = "ptgcontact_medium_emailaddress")
 */
abstract class EmailAddress extends \PtgContact\Entity\Medium
{
    /** 
     * @ORM\Column(type="string", length=255) 
     * @var string $address
     */
    protected $address;
    
    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }
    
    public function toString()
    {
	return \Dataservice\Inflector::humanize($this->getType())." - ".strtolower($this->getAddress());
    }
}
