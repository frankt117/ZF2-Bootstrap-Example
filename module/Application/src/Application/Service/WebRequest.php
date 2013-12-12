<?php
namespace Application\Service;

use PtgLead\Entity\Lead\WebRequest as WebRequestEntity,
    PtgBase\Service\ServiceAbstract;

class WebRequest extends ServiceAbstract
{
    protected $entityManager;
    
    /**
     * @return \Application\Form\WebRequest\GetStarted
     */
    public function getGetStartedForm()
    {
        return $this->getServiceManager()
            ->get('FormElementManager')
            ->get('application_form_webrequest_getstarted');
    }
    
    public function saveGetStarted($array)
    {
        $form   = $this->getGetStartedForm();
        $em     = $this->getEntityManager();
        
        $form->setData($array);
        
        if(!$form->isValid())
        {
            $form->setMessages(array("Please correct errors in the form"));
            throw new \Zend\Form\Exception\InvalidArgumentException("Form values are invalid");
        }
        
        $data = $form->getInputFilter()->getValues();
        
        $EmailAddress = $this->getLeadService()->getLeadEmailAddressRepository()->findOneBy(array("address" => $data["emailaddress"]));
        
        if(!$EmailAddress)
        {
            $Lead = new \PtgLead\Entity\Lead();
            
            $Lead->setName("Web Request Lead: ".date("m-d-Y H:i:s"));
            
            $EmailAddress = new \PtgLead\Entity\Lead\EmailAddress();
            
            $Lead->addEmailAddress($EmailAddress->setAddress($data["emailaddress"]));
            
            $em->persist($EmailAddress);  
        }
        else
        {
            $Lead = $EmailAddress->getLead();
        }
        
        $WebRequest = new WebRequestEntity();
        
        $WebRequest->setMessage($data["description"])
            ->setRequiresAttention(true);
        
        $Lead->getContactLog()->addContact($WebRequest);
        
        $em->persist($Lead->getContactLog());
        $em->persist($WebRequest);
        $em->persist($Lead);  
              
        $em->flush();
        
        return $Lead;
    }
    
    /**
     * @return \PtgLead\Service\Lead
     */
    public function getLeadService()
    {
        return $this->getServiceManager()->get("ptglead_service_lead");
    }
    
    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        if($this->entityManager === null)
        {
            $this->entityManager = $this->getServiceManager()->get("doctrine.entity_manager.orm_default");
        }
        
        return $this->entityManager;
    }
}