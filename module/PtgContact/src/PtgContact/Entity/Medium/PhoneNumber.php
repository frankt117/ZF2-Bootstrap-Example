<?php
namespace PtgContact\Entity\Medium;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity (repositoryClass="\PtgContact\Repository\Medium\PhoneNumber") 
 * @ORM\Table(name="ptgcontact_medium_phonenumbers") 
 * @PtgBase\Doctrine\DiscriminatorEntry(value = "ptgcontact_medium_phonenumber")
 */
abstract class PhoneNumber extends \PtgContact\Entity\Medium
{    
    /** 
     * @ORM\Column(type="string", length=3) 
     * @var integer $area_code
     */
    protected $area_code;
    
    /** 
     * @ORM\Column(type="string", length=3) 
     * @var integer $num1
     */
    protected $num1;
    
    /** 
     * @ORM\Column(type="string", length=4) 
     * @var integer $num2
     */
    protected $num2;
    
    /** 
     * @ORM\Column(type="string", length=7) 
     * @var string $extension
     */
    protected $extension = "";
    
    /**
     * @return integer
     */
    public function getAreaCode()
    {
        return $this->area_code;
    }
    
    /**
     * @param integer $area_code
     */
    public function setAreaCode($area_code)
    {
        $this->area_code = $area_code;
    }

    /**
     * @return string
     */
    public function getNum1()
    {
        return $this->num1;
    }

    /**
     * @param string $num1
     */
    public function setNum1($num1)
    {
        $this->num1 = $num1;
    }

    /**
     * @return string
     */
    public function getNum2()
    {
        return $this->num2;
    }

    /**
     * @param string $num2
     */
    public function setNum2($num2)
    {
        $this->num2 = $num2;
    }
    
    /**
     * @return string
     */
    public function getNumberDisplay()
    {
	return "(".$this->area_code.") ".$this->num1."-".$this->num2;
    }
    
    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }
    
    public function toString()
    {
	return \Dataservice\Inflector::humanize($this->getType())." - ".$this->getNumberDisplay();
    }
}