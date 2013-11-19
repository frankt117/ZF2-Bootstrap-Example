<?php
namespace TbAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

class CategoryController extends AbstractActionController
{
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

    protected $inputs = array();

    public function indexAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function completeAction(){
        $request = $this->getRequest();
        $em = $this->getEntityManager();
        if($request->isPost()){

            $post_data = $request->getPost();

        }

        return new ViewModel(array('a' => $post_data));
    }

    public function addAction(){

        $this->getTitleInput();
        $this->getSlugInput();
        $this->getImgDirInput();
        $this->getMainPicNameInput();
        $this->getSubDescriptionInput();
        $this->getDescriptionInput();
        $this->getAddEditPasswordInput();
        $this->getSaveButton();

        return new ViewModel(array('inputs' => $this->inputs));
    }

    public function editAction(){

        $this->getSelectCategoryInput();
        $this->getTitleInput();
        $this->getSlugInput();
        $this->getImgDirInput();
        $this->getMainPicNameInput();
        $this->getSubDescriptionInput();
        $this->getDescriptionInput();
        $this->getAddEditPasswordInput();
        $this->getSaveButton();

        return new ViewModel(array('inputs' => $this->inputs));
    }

    public function getSelectCategoryInput(){
        $em = $this->getEntityManager();

        $select = '<div class="form-group">
                <label for="select_category" class="col-sm-2 control-label">Select Category</label>
                <div class="col-sm-10">
                    <select class="form-control" id="select_category" name="select_category">
                    ';

            foreach($em->getRepository('\PtgTbCategory\Entity\Category')->findAll() as $category){
                $select .= '<option value="' . $category->id . '">' . $category->title .'</option>';
            }

        $select .=    '</select>
                </div>
            </div>';

        $this->inputs[] = $select;
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
                    <textarea class="form-control" rows="3" id="description" name="description">
                    Easily being our most popular items, our barns accommodate everything from horses, to livestock, to even RVs. With our wide variety and multiple sizes, we can build the ultimate barn to your specifications. From being 100% American made, to offering a 10 year warranty, we are positive we can build the perfect barn for your needs. Contact us today for pricing and details.
                    </textarea>
                </div>
            </div>';
    }

    public function getAddEditPasswordInput(){
        $this->inputs[] = '<div class="form-group">
                <label for="add_edit_password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="add_edit_password" name="add_edit_password">
                </div>
            </div>';
    }

    public function getSaveButton(){
        $this->inputs[] = '<div class="form-group">
            <div class="col-sm-offset-2 col-sm-10" style="text-align: center;">
              <button type="submit" class="btn btn-default">Save</button>
            </div>
          </div>';
    }


}
