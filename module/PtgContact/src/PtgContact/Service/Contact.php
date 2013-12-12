<?php
namespace PtgContact\Service;

use PtgBase\Service\ServiceAbstract;


class Lead extends ServiceAbstract
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;    
    
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
