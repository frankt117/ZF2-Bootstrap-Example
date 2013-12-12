<?php
namespace PtgContact\Entity\Medium\PhoneNumber;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity (repositoryClass="\PtgContact\Repository\Medium\PhoneNumber\Call") 
 * @ORM\Table(name="ptgcontact_medium_phonenumber_calls") 
 * @PtgBase\Doctrine\DiscriminatorEntry(value="PtgContact\Entity\Medium\PhoneNumber\Call")
 */
class Call extends \PtgContact\Entity\Contact
{
    
}