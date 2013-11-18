<?php
namespace TbAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

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

    public function updateAction(){

//        $em = $this->getEntityManager();
//        $PtgTbCategory = new \PtgTbCategory\Entity\Category();
//        $PtgTbCategory->description = "Looking for extra space for your tools and equipment, or the perfect spot for your ultimate man-cave? Our highly-customizable shops give you the space you need at an affordable price. From being 100% American made, to offering a 10 year warranty, we are positive we can build the perfect shop for your needs. Contact us today for pricing and details.";
//
//        $PtgTbCategory->title = "Shops";
//        $PtgTbCategory->image_directory = 'shops';
//        $PtgTbCategory->main_pic_src = 'shop.jpg';
//        $PtgTbCategory->slug = "shops";
//        $PtgTbCategory->subdescription = "The perfect choice for storing your tools and equipment, or building your ultimate man-cave.";
//
//
//        $em->persist($PtgTbCategory);
//        $em->flush();

    }
}
