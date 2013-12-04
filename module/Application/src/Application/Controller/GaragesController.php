<?php
namespace Application\Controller;

use Application\Controller\AbstractController,
    Zend\View\Model\ViewModel;

class GaragesController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
