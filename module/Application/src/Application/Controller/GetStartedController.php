<?php
namespace Application\Controller;

use Application\Controller\AbstractController,
    Zend\View\Model\ViewModel;

class GetStartedController extends AbstractController
{
    public function indexAction()
    {
        $request = $this->getRequest();
        $interested_dialog = '';

        if($request){
            $post_data = $request->getPost();
            $interested_in = $post_data['interested_in'] ? $post_data['interested_in'] : 'the products you offer';

            $interested_dialog = "Hello! I'm interested in the $interested_in, please have a specialist contact me to give me the best price and schedule the earliest installation!";
        }

        return new ViewModel(array('interested_dialog' => $interested_dialog));
    }

    public function estimateAction()
    {
        $request = $this->getRequest();

        if($request->isPost()){

            $post_data = $request->getPost();

            $email = $post_data['email'];
            $description = $post_data['description'];

            if(!empty($email) || strlen($email) != 0){
                $this->saveEmailAndDescription($email,$description);
            }

        }

        return new ViewModel();
    }

    protected function saveEmailAndDescription($email,$description){

        $this->getEntityManager();

        $PtgRequest = new \PtgLead\Entity\Lead\Request();
        $PtgRequest->email = $email;
        $PtgRequest->description = $description;

        $this->_em->persist($PtgRequest);
        $this->_em->flush();

    }
}
