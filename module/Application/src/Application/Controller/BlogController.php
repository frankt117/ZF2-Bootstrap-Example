<?php
namespace Application\Controller;

use Application\Controller\AbstractController,
    Zend\View\Model\ViewModel;

class BlogController extends AbstractController
{
    public function indexAction()
    {
        $page       = (int) $this->params()->fromRoute('page', 0);
        $paginator = $this->getBlogService()->getLatestPostsPaginator($page,5);

        return new ViewModel(array("paginator" => $paginator));
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

    public function showAction()
    {
        $slug = $this->params()->fromRoute('slug', 0);

        return new ViewModel(array("post" => $this->getBlogService()->getPostBySlug($slug)));
    }
}