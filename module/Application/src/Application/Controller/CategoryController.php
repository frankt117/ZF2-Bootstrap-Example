<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoryController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel(
            array(
                'category_slug' => $this->getEvent()->getRouteMatch()->getParam('category_slug')
            )
        );
    }
}
