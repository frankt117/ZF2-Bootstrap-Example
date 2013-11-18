<?php
namespace PtgTbCategory\Entity;

use Doctrine\ORM\Mapping as ORM,
    \Doctrine\Common\Collections\ArrayCollection;

/**
 * Category table entity.
 * @ORM\Entity
 * @ORM\Table(name="ptgtbcategory_categories")
 * @property string $image_directory
 * @property string $description
 * @property string $main_pic_src
 * @property string $slug
 * @property string $title
 * @property string $subdescription
 * @property \PtgTbCategory\Entity\Category\BulletPoint $BulletPoints
 * @property int $id
 */
class Category extends \PtgBase\Doctrine\Entity
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
    protected $image_directory;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;


    /**
     * @ORM\Column(type="string")
     */
    protected $main_pic_src;


    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $slug;


    /**
     * @ORM\Column(type="string")
     */
    protected $title;


    /**
     * @ORM\Column(type="string")
     */
    protected $subdescription;


    /**
     * @ORM\OneToMany(targetEntity="PtgTbCategory\Entity\Category\BulletPoint", mappedBy="Category")
     */
    protected $BulletPoints;

    public function __set($property, $value){
        $this->$property = $value;
    }

    public function __get($property){
        return $this->$property;
    }

    public function __construct(){
        parent::__construct();

        $this->BulletPoints = new ArrayCollection();
    }
}
