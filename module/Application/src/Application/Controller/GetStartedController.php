<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Application\Entity\Requests;

class GetStartedController extends AbstractActionController
{
	protected $em;
    
    protected function getEntityManager(){

    }


    public function indexAction()
    {
        return new ViewModel();
    }

    public function estimateAction()
    {
        return new ViewModel();
    }
}
