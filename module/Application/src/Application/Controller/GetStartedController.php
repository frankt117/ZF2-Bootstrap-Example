<?php
namespace Application\Controller;

use Application\Controller\AbstractController,
    Zend\View\Model\ViewModel;

class GetStartedController extends AbstractController
{
    public function indexAction()
    {
        $service    = $this->getWebRequestService();
        $form       = $service->getGetStartedForm();
        $request    = $this->getRequest();
        if($request->isPost())
        {
            $post = $request->getPost();
            
            try 
            {
                $service->saveGetStarted($post->toArray());

                return $this->redirect()->toRoute("estimate");
            }
            catch (\Exception $exc)
            {                        
                $this->flashMessenger()->setNamespace("get-started")->addErrorMessage("Could not submit form. Please try again");
            }
                
            $form->populateValues($post);
        }
        
        return new ViewModel(array("form" => $form));
    }

    public function estimateAction()
    {
        return new ViewModel();
    }
    
    /**
     * @return \Application\Service\WebRequest
     */
    public function getWebRequestService()
    {
        return $this->getServiceLocator()->get("application_service_webrequest");
    }
}
