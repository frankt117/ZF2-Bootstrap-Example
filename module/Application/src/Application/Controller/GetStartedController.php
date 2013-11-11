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

	if(null === $this->em){
		$this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
	}

	return $this->em;

    }


    public function indexAction()
    {
        return new ViewModel(array('records' => $this->getEntityManager()->getRepository('Application\Entity\Requests')));
    }

    public function estimateAction()
    {
        return new ViewModel();
    }
}
