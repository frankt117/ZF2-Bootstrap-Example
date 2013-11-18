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

        $PtgTbCategory->description = "Whether it's for your beloved car or motorcycle, or you just need the extra storage space, protect your property by securely storing it in one of our high-quality garages. From being 100% American made, to offering a 10 year warranty, we are positive we can build the perfect garage for your needs. Contact us today for pricing and details.";

        $PtgTbCategory->title = "Garages";
        $PtgTbCategory->image_directory = 'garages';
        $PtgTbCategory->main_pic_src = 'garage1.jpg';
        $PtgTbCategory->slug = "garages";
        $PtgTbCategory->subdescription = "Best solution for securely storing your car, motorcycle, or access property.";


        $em->persist($PtgTbCategory);
        $em->flush();

    }
}
