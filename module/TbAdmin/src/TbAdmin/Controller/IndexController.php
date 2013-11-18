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

        $em = $this->getEntityManager();
//        $PtgTbCategory = new \PtgTbCategory\Entity\Category();
//
//        $PtgTbCategory->description = 'Easily being our most popular items, our barns accommodate everything from horses, to livestock, to
//       even RV’s. With our wide variety and multiple sizes, we can build the ultimate barn to your specifications.
//       With our 10 year warranty and our barns being 100% American made, we are the perfect choice for you.';
//
//        $PtgTbCategory->title = "Barns";
//        $PtgTbCategory->image_directory = 'barns';
//        $PtgTbCategory->main_pic_src = 'building.jpg';
//        $PtgTbCategory->slug = "barns";
//        $PtgTbCategory->subdescription = "Affordable and built durable for your horses, livestock, and RV.  ";
//
//
//        $em->persist($PtgTbCategory);
//        $em->flush();


        $findby = $em->getRepository('\PtgTbCategory\Entity\Category')->findOneBy(array('slug' => 'barns'));
        $allrecs = $em->find('\PtgTbCategory\Entity\Category',1);
        return new ViewModel(array('allrecs' => $allrecs, 'findby' => $findby));
    }
}
