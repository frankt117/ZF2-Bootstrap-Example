<?php
namespace PtgContact\Entity\Medium\EmailAddress;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity (repositoryClass="\PtgContact\Repository\Medium\EmailAddress\Email") 
 * @ORM\Table(name="ptgcontact_medium_emailaddress_emails") 
 * @PtgBase\Doctrine\DiscriminatorEntry(value="PtgContact\Entity\Medium\EmailAddress\Email")
 */
class Email extends \PtgContact\Entity\Contact
{
    
}