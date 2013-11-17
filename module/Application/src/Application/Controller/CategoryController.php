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
                'category_title'            => $this->getCategoryTitle(),            // for now its the slug
                'description'               => $this->getCategoryDescription(),
                'category_image_directory'  => $this->getCategoryImageDirectory(),
                'category_slug'             => $this->getCategorySlug()
            )
        );
    }

    protected function getCategoryImageDirectory(){
        return APPLICATION_ROOT. '/img/' . $this->getCategorySlug();
    }

    /**
     * @TODO Replace this with a doctrine entity call to get description.
     * @return string
     */
    protected function getCategoryDescription(){
        return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi feugiat porttitor felis, et pulvinar quam
        convallis eget. Integer pulvinar imperdiet erat. Donec porttitor sagittis erat eu vestibulum. Fusce vehicula mollis
        leo. Nulla at placerat tellus, eu euismod arcu. Donec porttitor, felis quis malesuada tempor, mi justo feugiat orci,
        vitae accumsan enim elit sed purus. Curabitur rutrum, lectus at fermentum auctor, sem massa placerat ligula,
        id dignissim nisl augue eu sapien. Suspendisse euismod massa nec commodo hendrerit. Etiam vehicula viverra sapien,
        rhoncus auctor ante cursus nec. Quisque nisl turpis, lobortis at nisl in, pharetra auctor diam. Phasellus et vulputate
        purus. Morbi ut risus in nisi rhoncus posuere.';
    }

    /**
     * @TODO for now, replace this with call to doctrine for appropriate category specific title.
     * @return string
     */
    protected function getCategoryTitle(){
        return ucwords(str_replace("-", " ", $this->getCategorySlug()));
    }

    protected function getCategorySlug(){
        return $this->getEvent()->getRouteMatch()->getParam('category_slug');
    }
}
