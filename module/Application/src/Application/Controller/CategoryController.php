<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

class CategoryController extends AbstractActionController
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \PtgTbCategory\Entity\Category
     */
    protected $PtgTbCategory;

    protected function getEntityManager(){
        if( null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction()
    {
        $em         = $this->getEntityManager();
        $slug       = $this->getEvent()->getRouteMatch()->getParam('category_slug');
        $Category   = $em->getRepository('\PtgTbCategory\Entity\Category')->findOneBy(array('slug' => $slug));

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
            if ($gallery_image->isDot()
                || $gallery_image->isDir()
                || $gallery_image->getFilename() === 'index.php') continue;

            $tiles[$i]['filename'] = $gallery_image->getFilename();
            $tiles[$i]['image_directory'] = $this->PtgTbCategory->image_directory;
            $tiles[$i]['product_page_slug'] = 'the-product-you-clicked-on'; //Make Doctrine Call for the product slug.
            $tiles[$i]['product_name'] = 'Horse Barn'; //Make the call for this data too
            $tiles[$i]['product_price'] = number_format(11000,2,",",".");

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
     * @TODO make a real data call bro
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
     * @TODO for now, replace this with call to doctrine for appropriate category specific title.
     * @return string
     */
    protected function getCategoryTitle(){
        return ucwords(str_replace("-", " ", $this->PtgTbCategory->title));
    }

    protected function getCategorySlug(){
        return $this->PtgTbCategory->slug;
    }
}
