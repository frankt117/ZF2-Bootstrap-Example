<?php
namespace TbAdmin\Controller;

use TbAdmin\Controller\AbstractController,
    Zend\View\Model\ViewModel;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }
}
