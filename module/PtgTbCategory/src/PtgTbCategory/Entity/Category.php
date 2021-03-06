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
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     */
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $parent;


    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $slug;


    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="PtgTbProduct\Entity\Product", mappedBy="Categories")
     */
    protected $Products;

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
        $this->Products = new ArrayCollection();
        $this->BulletPoints = new ArrayCollection();
    }

    /**
     * @param PtgTbProduct\Entity\Product $product
     * @internal param \PtgTbCategory\Entity\PtgTbProduct\Entity\Product $post
     */
    public function addProduct(\PtgTbProduct\Entity\Product $product)
    {
        if ($this->Products->contains($product)) return;

        $this->Products->add($product);

        $product->addCategory($this);
    }

}
