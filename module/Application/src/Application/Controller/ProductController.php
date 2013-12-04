<?php
namespace Application\Controller;

use Application\Controller\AbstractController,
    Zend\View\Model\ViewModel;

class ProductController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(
            array(
                'product_slug' => $this->getEvent()->getRouteMatch()->getParam('product_slug')
            )
        );
    }
}
