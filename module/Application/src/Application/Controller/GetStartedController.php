<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

class GetStartedController extends AbstractActionController
{
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

    public function indexAction()
    {
        return new ViewModel();
    }

    public function estimateAction()
    {
        $request = $this->getRequest();

        if($request->isPost()){

            $post_data = $request->getPost();

            $email = $post_data['email'];
            $description = $post_data['description'];

            $this->saveEmailAndDescription($email,$description);

        }

        return new ViewModel();
    }

    protected function saveEmailAndDescription($email,$description){

        $this->getEntityManager();

        $PtgRequest = new \PtgLead\Entity\Lead\Request();
        $PtgRequest->email = $email;
        $PtgRequest->description = $description;

        $this->em->persist($PtgRequest);
        $this->em->flush();

    }
}
