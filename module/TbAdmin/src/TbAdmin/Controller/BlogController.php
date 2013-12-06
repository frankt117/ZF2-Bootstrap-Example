<?php
namespace TbAdmin\Controller;

use Zend\View\Model\ViewModel,
    TbAdmin\Controller\AbstractController;

class BlogController extends AbstractController
{
    protected $blogService;
    
    public function indexAction()
    {
        return new ViewModel();
    }
    
    /**
     * getBlogService
     *
     * @return \WdgBlog\Service\Blog
     */
    public function getBlogService()
    {
        if (null === $this->blogService)
        {
            $this->blogService = $this->getServiceLocator()->get('wdgblog_service_blog');
        }
        return $this->blogService;
    }
}