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

        $PtgTbCategory->description = 'Having new toys for work or the farm is fun, but storing them can be a hassle. Our sheds provide you with the best storage solution for your tractors, ATV’s, or bulldozers at an affordable price. From being 100% American made, to offering a 10 year warranty, we are positive we can build the perfect shed for your needs. Contact us today for pricing and details.';

        $PtgTbCategory->title = "Sheds";
        $PtgTbCategory->image_directory = 'sheds';
        $PtgTbCategory->main_pic_src = 'shed2.jpg';
        $PtgTbCategory->slug = "sheds";
        $PtgTbCategory->subdescription = "The best storage solution for your tractors, ATV's, and bulldozers.";


        $em->persist($PtgTbCategory);
        $em->flush();

    }
}
