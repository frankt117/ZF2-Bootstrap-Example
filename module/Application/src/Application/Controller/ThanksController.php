<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ThanksController extends AbstractActionController
{
    public function indexAction()
    {
        echo "hsa";
        return new ViewModel();
    }
}
