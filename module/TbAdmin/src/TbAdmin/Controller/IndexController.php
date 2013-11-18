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
        $PtgTbCategory = new \PtgTbCategory\Entity\Category();

        $PtgTbCategory->description = 'Mother Nature can take her toll on your vehicle. Rest assured knowing your car is safe under our extremely durable carports. Coming in such a wide variety, at an affordable price, there is no reason to not take advantage of these products, today. From being 100% American made, to offering a 10 year warranty, we are positive we can build the perfect carport for your needs. Contact us today for pricing and details.';

        $PtgTbCategory->title = "Carports";
        $PtgTbCategory->image_directory = 'carports';
        $PtgTbCategory->main_pic_src = 'aframe.jpg';
        $PtgTbCategory->slug = "carports";
        $PtgTbCategory->subdescription = "The affordable way to protect your vehicle from the elements.";


        $em->persist($PtgTbCategory);
        $em->flush();

    }
}
