<?php
namespace TbAdmin\Controller;

use TbAdmin\Controller\AbstractController,
    Zend\View\Model\ViewModel;

class LeadController extends AbstractController
{
    protected $serviceLead;
    
    public function showAction()
    {
        return new ViewModel(
            array(
                "lead" => $this->getLeadService()
                    ->get($this->getEvent()->getRouteMatch()->getParam("id"))
            )
        );
    }
    
    public function addAction()
    {
        $service    = $this->getLeadService();
        $form       = $service->getAddForm();
        $request    = $this->getRequest();
        
        if($request->isPost())
        {
            $post = $request->getPost();
            
            try 
            {
                $Lead = $service->add($post->toArray());
                
                $this->flashMessenger()->addSuccessMessage("Lead Added");

                return $this->redirect()->toRoute("tb-admin/lead/show", array("id" => $Lead->getId()));
            }
            catch (\Exception $exc)
            {
                $this->flashMessenger()->addErrorMessage("Could not add Lead: ".$exc->getMessage());
            }
                
            $form->populateValues($post);
        }
        
        return new ViewModel(array("form" => $form));
    }
    
    public function listAction()
    {
        return new ViewModel(array("leads" => $this->getLeadService()->getAll()));
    }
    
    public function editAction()
    {
        $this->getServiceLocator()
            ->get('viewhelpermanager')
            ->get('HeadScript')
            ->prependFile('/ckeditor/ckeditor.js');
        
        $service    = $this->getLeadService();
        $form       = $service->getEditForm($this->getEvent()->getRouteMatch()->getParam("id"));
        $request    = $this->getRequest();
        
        if($request->isPost())
        {
            $post = $request->getPost();
            
            try 
            {
                $Lead = $service->edit($post->toArray());
                
                $this->flashMessenger()->addSuccessMessage("Lead Edited");

                return $this->redirect()->toRoute("tb-admin/lead/show", array("id" => $Lead->getId()));
            }
            catch (\Exception $exc)
            {
                $this->flashMessenger()->addErrorMessage("Could not edit Lead: ".$exc->getMessage());
            }
                
            $form->populateValues($post);
        }
        
        return new ViewModel(array("form" => $form));
    }
    
    /**
     * @return \WdgLead\Service\Lead
     */
    protected function getLeadService()
    {
        if(!$this->serviceLead)
            $this->serviceLead = $this->getServiceLocator()->get('ptglead_service_lead');
        
        return $this->serviceLead;
    }
}