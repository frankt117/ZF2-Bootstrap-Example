<?php
namespace TbAdmin\Controller;

use TbAdmin\Controller\AbstractController,
    Zend\View\Model\ViewModel;

class UserController extends AbstractController
{
    protected $serviceUser;
    
    protected $serviceAuth;
    
    public function showAction()
    {
        return new ViewModel(
            array(
                "user" => $this->getUserService()
                    ->get($this->getEvent()->getRouteMatch()->getParam("id"))
            )
        );
    }
    
    public function addAction()
    {
        $service    = $this->getUserService();
        $form       = $service->getAddForm();
        $request    = $this->getRequest();
        
        if($request->isPost())
        {
            $post = $request->getPost();
            
            try 
            {
                $User = $service->add($post->toArray());
                
                $this->flashMessenger()->addSuccessMessage("User Added");

                return $this->redirect()->toRoute("tb-admin/user/show", array("id" => $User->getId()));
            }
            catch (\Exception $exc)
            {
                $this->flashMessenger()->addErrorMessage("Could not add User: ".$exc->getMessage());
            }
                
            $form->populateValues($post);
        }
        
        return new ViewModel(array("form" => $form));
    }
    
    public function listAction()
    {
        return new ViewModel(array("users" => $this->getUserService()->getAll()));
    }
    
    public function editAction()
    {
        $this->getServiceLocator()
            ->get('viewhelpermanager')
            ->get('HeadScript')
            ->prependFile('/ckeditor/ckeditor.js');
        
        $service    = $this->getUserService();
        $form       = $service->getEditForm($this->getEvent()->getRouteMatch()->getParam("id"));
        $request    = $this->getRequest();
        
        if($request->isPost())
        {
            $post = $request->getPost();
            
            try 
            {
                $User = $service->edit($post->toArray());
                
                $this->flashMessenger()->addSuccessMessage("User Edited");

                return $this->redirect()->toRoute("tb-admin/user/show", array("id" => $User->getId()));
            }
            catch (\Exception $exc)
            {
                $this->flashMessenger()->addErrorMessage("Could not edit User: ".$exc->getMessage());
            }
                
            $form->populateValues($post);
        }
        
        return new ViewModel(array("form" => $form));
    }
    
    /**
     * @return \WdgUser\Service\User
     */
    protected function getUserService()
    {
        if(!$this->serviceUser)
            $this->serviceUser = $this->getServiceLocator()->get('ptguser_service_user');
        
        return $this->serviceUser;
    }
}