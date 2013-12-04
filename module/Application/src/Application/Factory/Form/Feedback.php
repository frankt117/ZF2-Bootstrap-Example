<?php
namespace Application\Factory\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Feedback implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $form = new \Application\Form\Feedback;
        $form->setInputFilter(new \Application\Filter\Feedback);

        return $form;
    }
}