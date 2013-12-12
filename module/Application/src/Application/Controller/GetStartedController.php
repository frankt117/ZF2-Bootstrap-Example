<?php
namespace Application\Controller;

use Application\Controller\AbstractController,
    Zend\View\Model\ViewModel;

class GetStartedController extends AbstractController
{
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

            if(!empty($email) || strlen($email) != 0){
                $this->saveEmailAndDescription($email,$description);
            }

        }

        return new ViewModel();
    }
}
