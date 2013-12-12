<?php
namespace PtgContact\Entity\Medium;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity (repositoryClass="\PtgContact\Repository\Medium\WebRequest") 
 * @ORM\Table(name="ptgcontact_medium_webrequests")
 * @PtgBase\Doctrine\DiscriminatorEntry(value = "ptgcontact_medium_webrequests")
 */
abstract class WebRequest extends \PtgContact\Entity\Medium
{
}
