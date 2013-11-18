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
        $PtgTbCategory   = $em->getRepository('\PtgTbCategory\Entity\Category')->findOneBy(array('slug' => 'Cottages'));
        $PtgTbCategory->description = "Whether it’s for your bed and breakfast, or you are needing the extra room for the in-laws, our high-quality cottages are built with the style you want at a very affordable price. From being 100% American made, to offering a 10 year warranty, we are positive we can design the perfect cottage for your needs. Contact us today for pricing and details.";

        $PtgTbCategory->title = "Cottages";
        $PtgTbCategory->image_directory = 'cottages';
        $PtgTbCategory->main_pic_src = 'cottage6.jpg';
        $PtgTbCategory->slug = "cottages";
        $PtgTbCategory->subdescription = "Styled for you at an affordable price.";


        $em->persist($PtgTbCategory);
        $em->flush();

    }
}
