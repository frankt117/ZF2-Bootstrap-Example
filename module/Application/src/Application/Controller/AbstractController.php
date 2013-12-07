<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Doctrine\ORM\EntityManager;

abstract class AbstractController extends AbstractActionController
{
    /**
     * @var EntityManager
     */
    protected $_em;
    
    /**
     * @return bool
     */
    public function isAjaxRequest()
    {
        return $this->getRequest()->isXmlHttpRequest();
    }

    /**
     * @return type
     */
    protected function getEntityManager()
    {
        if( null === $this->_em)
        {
            $this->_em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        
        return $this->_em;
    }

    /**
     *
     */
    protected function printPre($string)
    {
        echo ('<pre>'.print_r($string,1).'</pre>');
    }
}
