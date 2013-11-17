<?php
namespace PtgLead\Entity\Lead;

use Doctrine\ORM\Mapping as ORM;

/**
* Request table entity.
* @ORM\Entity
* @ORM\Table(name="ptglead_requests")
* @property string $email
* @property string $description
* $property int $id
*/
class Request
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
    protected $email;

    /**
    * @ORM\Column(type="string")
    */
    protected $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="PtgLead\Entity\Lead", inversedBy="Requests")
     * @ORM\JoinColumn(name="ptglead_lead_id", referencedColumnName="id")
     */
    protected $Lead;

    public function __set($property, $value){
        $this->$property = $value;
    }

    public function __get($property){
        return $this->$property;
    }
}
