<?php
namespace Application\Controller;

use Application\Controller\AbstractController,
    Zend\View\Model\ViewModel;

class ProductController extends AbstractController
{
    public function indexAction()
    {
        $em = $this->getEntityManager();
        $slug       = $this->getEvent()->getRouteMatch()->getParam('product_slug');
        $Product    = $em->getRepository('\PtgTbProduct\Entity\Product')->findOneBy(array('slug' => $slug));

        $return = null;

        if($Product instanceof \PtgTbProduct\Entity\Product){
            $return = new ViewModel(array(
                'name' => $Product->name,
                'description' => $Product->description,
                'subdescription' => $Product->subdescription,
                'image_directory' => $Product->image_directory,
                'main_pic_src' => $Product->main_pic_src
            ));
        } else {
          $this->getResponse()->setStatusCode(404);
        }



        return $return;
    }
}
