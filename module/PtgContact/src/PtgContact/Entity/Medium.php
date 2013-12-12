<?php
namespace PtgContact\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity (repositoryClass="\PtgContact\Repository\Medium") 
 * @ORM\Table(name="ptgcontact_mediums") 
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"ptgcontact_medium" = "PtgContact\Entity\Medium"})
 * @PtgBase\Doctrine\DiscriminatorEntry(value = "ptgcontact_medium")
 */
abstract class Medium extends \PtgBase\Doctrine\Entity
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer");
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;
    
    public function getId()
    {
        return $this->id;
    }
}
