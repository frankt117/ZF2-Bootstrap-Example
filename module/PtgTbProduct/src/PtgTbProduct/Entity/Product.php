<?php
namespace PtgTbProduct\Entity;

use Doctrine\ORM\Mapping as ORM,
    \Doctrine\Common\Collections\ArrayCollection,
    \PtgTbCategory\Entity\Category;

/**
 * Product table entity.
 * @ORM\Entity
 * @ORM\Table(name="ptgtbproduct_categories")
 * @property string $image_directory
 * @property string $description
 * @property string $main_pic_src
 * @property string $slug
 * @property string $title
 * @property string $subdescription
 * @property \PtgTbProduct\Entity\Product\BulletPoint $BulletPoints
 * @property int $id
 */
class Product extends \PtgBase\Doctrine\Entity
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
     * @ORM\Column(type="integer")
     */
    protected $price;


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
    protected $name;


    /**
     * @ORM\Column(type="string")
     */
    protected $subdescription;

    /**
     * @ORM\OneToOne(targetEntity="\PtgTbCategory\Entity\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $main_category;

    /**
     * @ORM\OneToOne(targetEntity="\PtgTbCategory\Entity\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $sub_category;

    /**
     * @ORM\OneToMany(targetEntity="PtgTbProduct\Entity\Product\BulletPoint", mappedBy="Product")
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
