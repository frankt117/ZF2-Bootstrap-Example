<?php
namespace Application\Controller;

use Application\Controller\AbstractController,
    Zend\View\Model\ViewModel;

class CategoryController extends AbstractController
{
    /**
     * @var \PtgTbCategory\Entity\Category
     */
    protected $PtgTbCategory;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $_em;

    public function indexAction()
    {
        $this->_em         = $this->getEntityManager();
        $slug       = $this->getEvent()->getRouteMatch()->getParam('category_slug');
        $Category   = $this->_em->getRepository('\PtgTbCategory\Entity\Category')->findOneBy(array('slug' => $slug));

        if ($Category instanceof \PtgTbCategory\Entity\Category){
            $this->PtgTbCategory = $Category;
        }
        // else redirect to 404 ?

        return new ViewModel(
            array(
                'category_title'            => $this->getCategoryTitle(),            // for now its the slug
                'description'               => $this->getCategoryDescription(),
                'category_image_directory'  => $this->getCategoryImageDirectory(),
                'category_slug'             => $this->getCategorySlug(),
                'category_main_pic_src'     => $this->getCategoryMainPicSrc(),
                'category_subdescription'   => $this->getCategorySubdescription(),
                'category_feature_bullet_points' => $this->getCategoryFeatureBulletPoints(),
                'gallery_tiles'             => $this->getGalleryTiles()
            )
        );
    }

    /**
     * This will pull from product entities too.
     * @return array
     */
    public function getGalleryTiles(){

        $tiles = array();
        $i = 0;
        foreach(new \DirectoryIterator($this->getCategoryImageDirectory()) as $gallery_image){

            if(strpos($gallery_image->getFilename(), 'render') !== FALSE)
                continue;

            if ($gallery_image->isDot()
                || $gallery_image->isDir()
                || $gallery_image->getFilename() === 'index.php') continue;


            $Product = $this->_em->getRepository('\PtgTbProduct\Entity\Product')->findOneBy(array(
                'main_pic_src' => $gallery_image->getFilename()
            ));

            if ($Product instanceof \PtgTbProduct\Entity\Product){
                $tiles[$i]['filename'] = $Product->main_pic_src;
                $tiles[$i]['image_directory'] = $Product->image_directory;
                $tiles[$i]['product_page_slug'] = $Product->slug;
                $tiles[$i]['product_name'] = $Product->name;
                $tiles[$i]['product_price'] = number_format($Product->price,2,",",".");
                unset($Product);
            }

            $i++;

        }

        return $tiles;
    }

    /**
     * Do a doctrine query for these
     * @return array
     */
    protected function getCategoryFeatureBulletPoints(){
        return array(
            '10 Year Warranty',
            'American Made',
            'Built to Last',
            'Made to fit your needs',
            'Guaranteed Lowest Price'
        );
    }

    /**
     * @return string
     */
    protected function getCategorySubdescription(){
        return $this->PtgTbCategory->subdescription;
    }

    /**
     * Builds Category Main Pic src for img tag in Category view.
     * @return string
     */
    protected function getCategoryMainPicSrc(){
        return '/img/'. $this->PtgTbCategory->image_directory .'/' . $this->PtgTbCategory->main_pic_src;
    }

    protected function getCategoryImageDirectory(){
        return APPLICATION_ROOT . '/img/' . $this->PtgTbCategory->image_directory;
    }

    /**
     * Gets Category description.
     * @return string
     */
    protected function getCategoryDescription(){
        return $this->PtgTbCategory->description;
    }

    /**
     * @return string
     */
    protected function getCategoryTitle(){
        return ucwords(str_replace("-", " ", $this->PtgTbCategory->title));
    }

    protected function getCategorySlug(){
        return $this->PtgTbCategory->slug;
    }
}
