<?php
namespace TbAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoryController extends AbstractActionController
{
    protected $inputs = array();

    public function indexAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    protected function getEntityManager(){
        if( null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function addAction(){

        $this->getTitleInput();
        $this->getSlugInput();
        $this->getImgDirInput();
        $this->getMainPicNameInput();
        $this->getSubDescriptionInput();
        $this->getDescriptionInput();

        return new ViewModel(array('inputs' => $this->inputs));
    }

    public function editAction(){

        $this->getTitleInput();
        $this->getSlugInput();
        $this->getImgDirInput();
        $this->getMainPicNameInput();
        $this->getSubDescriptionInput();
        $this->getDescriptionInput();

        return new ViewModel(array('inputs' => $this->inputs));
    }

    public function getTitleInput(){
        $this->inputs[] = '<div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Barns">
                </div>
            </div>';
    }

    public function getSlugInput(){
        $this->inputs[] = '<div class="form-group">
                <label for="slug" class="col-sm-2 control-label">Slug</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="barns">
                </div>
            </div>';
    }

    public function getImgDirInput(){
        $this->inputs[] = '<div class="form-group">
                <label for="image_directory" class="col-sm-2 control-label">Image Directory</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="image_directory" name="image_directory" placeholder="barns">
                </div>
            </div>';
    }

    public function getMainPicNameInput(){
        $this->inputs[] = '<div class="form-group">
                <label for="main_pic_name" class="col-sm-2 control-label">Main Image Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="main_pic_name" name="main_pic_name" placeholder="barn1.jpg">
                </div>
            </div>';
    }

    public function getSubDescriptionInput(){
        $this->inputs[] = '<div class="form-group">
                <label for="subdescription" class="col-sm-2 control-label">Sub Description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="subdescription" name="subdescription" placeholder="Affordable and built durable for your horses, livestock, and RV.">
                </div>
            </div>';
    }

    public function getDescriptionInput(){
        $this->inputs[] = '<div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" id="description" name="description"
                    value="Easily being our most popular items, our barns accommodate everything from horses, to livestock, to even RV’s. With our wide variety and multiple sizes, we can build the ultimate barn to your specifications. From being 100% American made, to offering a 10 year warranty, we are positive we can build the perfect barn for your needs. Contact us today for pricing and details.">
                </div>
            </div>';
    }


}
