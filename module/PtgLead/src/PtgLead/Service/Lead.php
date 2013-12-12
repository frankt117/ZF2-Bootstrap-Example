<?php
namespace PtgLead\Service;

use Zend\Form\Form,
    PtgBase\Service\ServiceAbstract,
    PtgLead\Entity\Lead as LeadEntity;


class Lead extends ServiceAbstract
{
    /**
     * @var \PtgLead\Repository\Lead
     */
    protected $leadRepos;

    /**
     * @var Form
     */
    protected $editForm;

    /**
     * @var Form
     */
    protected $addForm;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;
    
    /**
     * @param int $id
     * @return LeadEntity
     */
    public function get($id)
    {
        return $this->getLeadRepository()->find($id);
    }
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getAll()
    {
        return $this->getLeadRepository()->findAll();
    }
    
    public function getOneByName($name)
    {
        return $this->getLeadRepository()->findOneBy(array("name" => $name));
    }
    
    public function getOneByEmailAddress($emailaddress)
    {
        
    }

    /**
     * createFromForm
     *
     * @param array $data
     * @return \PtgLead\Entity\Lead
     * @throws Exception\InvalidArgumentException
     */
    public function add(array $post)
    {
        $form   = $this->getAddForm();
        $em     = $this->getEntityManager();
        
        $form->setData($post);
        
        if(!$form->isValid())
            throw new \PtgLead\Exception\Service\Lead\FormException("Form values are invalid:");

        $data   = $form->getInputFilter()->getValues();
        $Lead   = new LeadEntity();
        
        $Lead->setName($data["name"]);
        
        $em->persist($Lead);        
        $em->flush();
        
        return $Lead;
    }

    /**
     * createFromForm
     *
     * @param array $data
     * @return \PtgLead\Entity\Lead
     * @throws Exception\InvalidArgumentException
     */
    public function edit(array $post)
    {
        $form   = $this->getEditForm();
        $em     = $this->getEntityManager();
        
        $form->setData($post);
        
        if(!$form->isValid())
            throw new \PtgLead\Exception\Service\Lead\FormException("Form values are invalid:");

        $data   = $form->getInputFilter()->getValues();
        $Lead   = $this->get($data["id"]);
        
        $Lead->setName($data["name"]);
        
        $em->persist($Lead);        
        $em->flush();
        
        return $Lead;
    }
    
    public function remove($id)
    {
        $Lead   = $this->get($id);
        
        if(!$Lead)throw new \Exception("No lead with that id.");
        
        $em     = $this->getEntityManager();
        
        $em->remove($Lead);
        $em->flush();
        
        return $this;
    }
    
    public function getLeadEmailAddressRepository()
    {
        return $this->getEntityManager()->getRepository('PtgLead\Entity\Lead\EmailAddress');
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getLeadRepository()
    {
        if (null === $this->leadRepos)
        {
            $this->leadRepos = $this->getServiceManager()->get('ptglead_lead_repos');
        }
        
        return $this->leadRepos;
    }

    /**
     * @param \Doctrine\ORM\EntityRepository $leadRepos
     * @return Lead
     */
    public function setLeadRepository(\Doctrine\ORM\EntityRepository $leadRepos)
    {
        $this->leadRepos = $leadRepos;
        
        return $this;
    }

    /**
     * @return Form
     */
    public function getEditForm($id = null)
    {
        if (null === $this->editForm)
        {
            $this->editForm = $this->getServiceManager()->get('FormElementManager')->get('ptglead_edit_form');
        }
        
        $form = $this->editForm;
        
        if($id && $lead = $this->get($id))
        {
            $form->populateValues($lead->toArray());
        }
        
        return $this->editForm;
    }

    /**
     * @return Form
     */
    public function getAddForm()
    {
        if (null === $this->addForm)
        {
            $this->addForm = $this->getServiceManager()->get('FormElementManager')->get('ptglead_add_form');
        }
        
        return $this->addForm;
    }

    /**
     * @param Form $editForm
     * @return Lead
     */
    public function setEditForm(Form $editForm)
    {
        $this->editForm = $editForm;
        
        return $this;
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
