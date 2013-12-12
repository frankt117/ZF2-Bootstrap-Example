<?php
namespace Application\View\Helper;
 
use Zend\ServiceManager\ServiceLocatorInterface;
 
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
 
class ProductLinks extends AbstractHelper implements ServiceLocatorAwareInterface {

    private $serviceLocator;

    private $_em;

    /**
     * Pass in which image directory you're looking under, and it will supply you with products' links that use that
     * image directory.
     * @param $category_slug
     */
    public function __invoke($image_directory) {

        $this->_em = $this->serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $Products = $this->_em->getRepository('\PtgTbProduct\Entity\Product')->findBy(array('image_directory'=>$image_directory));

        $link_array = array();

        foreach ($Products as $Product ){
            $link_array[] = '<li class="menu-item "><a href="/pr/' . $Product->slug . '">' . $Product->name . '</a></li>';
        }

        return $link_array;
    }

    /**
    * Set service locator
    *
    * @param ServiceLocatorInterface $serviceLocator
    */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }

    /**
    * Get service locator
    *
    * @return ServiceLocatorInterface
    */
    public function getServiceLocator() {
        return $this->serviceLocator;
    }

}