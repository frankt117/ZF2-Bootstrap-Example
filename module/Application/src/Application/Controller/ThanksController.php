<?php
namespace Application\Controller;

use Application\Controller\AbstractController,
    Zend\View\Model\ViewModel;

class ThanksController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
