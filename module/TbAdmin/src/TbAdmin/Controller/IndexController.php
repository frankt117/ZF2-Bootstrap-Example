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
        $PtgTbCategory->description = "Let us prevent foundation issues by professionally pouring a concrete foundation for any of your, recently bought, steel framed structures. Trust in us, to make sure your structures are securely supported from the ground up. Contact us today for pricing and details.";

        $PtgTbCategory->title = "Concrete";
        $PtgTbCategory->image_directory = 'concrete';
        $PtgTbCategory->main_pic_src = 'concrete.jpg';
        $PtgTbCategory->slug = "concrete";
        $PtgTbCategory->subdescription = "Best foundation choice for your steel framed structure.";


        $em->persist($PtgTbCategory);
        $em->flush();

    }
}
