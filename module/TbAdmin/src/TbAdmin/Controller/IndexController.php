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
//        $PtgTbCategory->description = 'Barns are awesome and this is their unique description Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi feugiat porttitor felis, et pulvinar quam
//        convallis eget. Integer pulvinar imperdiet erat. Donec porttitor sagittis erat eu vestibulum. Fusce vehicula mollis';
//
//        $PtgTbCategory->title = "Barns";
//        $PtgTbCategory->image_directory = 'barns';
//        $PtgTbCategory->main_pic_src = 'building.jpg';
//        $PtgTbCategory->slug = "barns";
//        $PtgTbCategory->subdescription = "The Agricultural building you need, built to suit.";
//        $PtgTbCategory->BulletPoints = array(
//            '10 Year Warranty',
//            'American Made',
//            'Built to Last',
//            'Made to fit your needs',
//            'Guaranteed Lowest Price'
//        );
//
//        $em->persist($PtgTbCategory);
//        $em->flush();


        $allrecs = $em->getRepository('\PtgTbCategory\Entity\Category')->findAll();

        return new ViewModel(array('allrecs' => $allrecs));
    }
}
