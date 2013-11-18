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
        $PtgTbCategory->description = "Humans are not the only species we build for. Whether it’s for the beloved family dog, or for your chickens out back, we build high-quality dog houses and chicken coops at an affordable price. From being 100% American made, to offering a 10 year warranty, we are positive we can build the perfect housing for your animals. Contact us today for pricing and details.";

        $PtgTbCategory->title = "Pet &amp; Animal Housing";
        $PtgTbCategory->image_directory = 'pet';
        $PtgTbCategory->main_pic_src = 'chickencoop.png';
        $PtgTbCategory->slug = "pet-animal-housing";
        $PtgTbCategory->subdescription = "Custom housing for your dogs and chickens.";


        $em->persist($PtgTbCategory);
        $em->flush();

    }
}
