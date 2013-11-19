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

    public function findAction(){
        $this->getSelectCategoryInput();
        $this->getNextButton();

        return new ViewModel(array('inputs' => $this->inputs));
    }

    public function completeAction(){
        $request = $this->getRequest();
        $authorized = false;
        if($request->isPost()){

            $post_data = $request->getPost();

            if($post_data['add_edit_password'] == 'M@dM0ney'){
                $authorized = true;
                $this->saveData($post_data);
            }

        }

        return new ViewModel(array('authorized' => $authorized));
    }

    protected function saveData($post_data){
        if ($post_data['select_category']){ //edit mode
            $this->editCategory($post_data);
        }
        else {                              // new addition
            $this->addCategory($post_data);
        }
    }

    protected function editCategory($post_data){
        $em = $this->getEntityManager();

        $PtgTbCategory = $em->getRepository('\PtgTbCategory\Entity\Category')->findOneBy(array('id' => $post_data['select_category']));

    }

    protected function addCategory(){

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

        $em = $this->getEntityManager();
        $request = $this->getRequest();

        if($request->isPost()){

            $post_data = $request->getPost();
            $c   = $em->getRepository('\PtgTbCategory\Entity\Category')->findOneBy(array('id' => $post_data['select_category']));
            if($c instanceof \PtgTbCategory\Entity\Category){

                $this->getTitleInput($c->title);
                $this->getSlugInput($c->slug);
                $this->getImgDirInput($c->image_directory);
                $this->getMainPicNameInput($c->main_pic_src);
                $this->getSubDescriptionInput($c->subdescription);
                $this->getDescriptionInput($c->description);
                $this->getAddEditPasswordInput();
                $this->getSaveButton();

            }

        }

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

    public function getTitleInput($v = ''){
        $title = '<div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Barns" ';

        if($v) $title .= 'value ="' . $v .'" ';

        $title .= ' >
                </div>
            </div>';

        $this->inputs[] = $title;
    }

    public function getSlugInput($v = ''){
        $slug = '<div class="form-group">
                <label for="slug" class="col-sm-2 control-label">Slug</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="barns"';
        if($v) $slug .= 'value ="' . $v .'" ';

        $slug .= ' >
                </div>
            </div>';

        $this->inputs[] = $slug;
    }

    public function getImgDirInput($v = ''){
        $img_dir = '<div class="form-group">
                <label for="image_directory" class="col-sm-2 control-label">Image Directory</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="image_directory" name="image_directory" placeholder="barns"';
        if($v) $img_dir .= 'value ="' . $v .'" ';

        $img_dir .= ' >
                </div>
            </div>';

        $this->inputs[] = $img_dir;
    }

    public function getMainPicNameInput($v = ''){
        $main_pic = '<div class="form-group">
                <label for="main_pic_name" class="col-sm-2 control-label">Main Image Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="main_pic_name" name="main_pic_name" placeholder="barn1.jpg"';
        if($v) $main_pic .= 'value ="' . $v .'" ';

        $main_pic .= ' >
                </div>
            </div>';

        $this->inputs[] = $main_pic;
    }

    public function getSubDescriptionInput($v = ''){
        $subdesc = '<div class="form-group">
                <label for="subdescription" class="col-sm-2 control-label">Sub Description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="subdescription" name="subdescription" placeholder="Affordable and built durable for your horses, livestock, and RV."';
        if($v) $subdesc .= 'value ="' . $v .'" ';

        $subdesc .= ' >
                </div>
            </div>';

        $this->inputs[] = $subdesc;
    }

    public function getDescriptionInput($v = ''){
        $this->inputs[] = '<div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" id="description" name="description">
                    '. $v .'
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

    public function getNextButton(){
        $this->inputs[] = '<div class="form-group">
            <div class="col-sm-offset-2 col-sm-10" style="text-align: center;">
              <button type="submit" class="btn btn-default">Next</button>
            </div>
          </div>';
    }


}
