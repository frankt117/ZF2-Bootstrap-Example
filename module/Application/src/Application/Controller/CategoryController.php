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

    protected function getEntityManager(){
        if( null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction()
    {
        $slug = $this->getEvent()->getRouteMatch()->getParam('category_slug');

        //TODO: Pick up here early tomorrow. Rise And Grind baby.
//        $em = $this->getEntityManager();
//
//        $PtgTbCategory = new \PtgTbCategory\Entity\Category();
//
//        $PtgTbCategory->description = 'Barns are awesome and this is their unique description Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi feugiat porttitor felis, et pulvinar quam
//        convallis eget. Integer pulvinar imperdiet erat. Donec porttitor sagittis erat eu vestibulum. Fusce vehicula mollis';
//
//        $PtgTbCategory->title = "Barns";
//        $PtgTbCategory->image_directory = '';

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
            $tiles[$i]['image_directory'] = $this->getCategorySlug();
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
        return 'Subdescription for ' . $this->getCategorySlug() . ' page goes here.';
    }

    /**
     * @TODO Replace building.jpg with doctrine call for data.
     * @return string
     */
    protected function getCategoryMainPicSrc(){
        return '/img/'. $this->getCategorySlug() .'/building.jpg';
    }

    protected function getCategoryImageDirectory(){
        return APPLICATION_ROOT. '/img/' . $this->getCategorySlug();
    }

    /**
     * @TODO Replace this with a doctrine entity call to get description.
     * @return string
     */
    protected function getCategoryDescription(){
        return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi feugiat porttitor felis, et pulvinar quam
        convallis eget. Integer pulvinar imperdiet erat. Donec porttitor sagittis erat eu vestibulum. Fusce vehicula mollis
        leo. Nulla at placerat tellus, eu euismod arcu. Donec porttitor, felis quis malesuada tempor, mi justo feugiat orci,
        vitae accumsan enim elit sed purus. Curabitur rutrum, lectus at fermentum auctor, sem massa placerat ligula,
        id dignissim nisl augue eu sapien. Suspendisse euismod massa nec commodo hendrerit. Etiam vehicula viverra sapien,
        rhoncus auctor ante cursus nec. Quisque nisl turpis, lobortis at nisl in, pharetra auctor diam. Phasellus et vulputate
        purus. Morbi ut risus in nisi rhoncus posuere.';
    }

    /**
     * @TODO for now, replace this with call to doctrine for appropriate category specific title.
     * @return string
     */
    protected function getCategoryTitle(){
        return ucwords(str_replace("-", " ", $this->getCategorySlug()));
    }

    protected function getCategorySlug(){
        return $this->getEvent()->getRouteMatch()->getParam('category_slug');
    }
}
