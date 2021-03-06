<?php
namespace TbAdmin\Controller;

use TbAdmin\Controller\AbstractController,
    Zend\View\Model\ViewModel;

class CategoryController extends AbstractController
{
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

        if($request->isPost()){
            $result = $this->saveData($request->getPost());
        }

        return new ViewModel(array('result' => $result));
    }

    protected function saveData($post_data){
        if ($post_data['select_category']){ //edit mode
            $result = $this->editCategory($post_data);
        }
        else {                              // new addition
            $result = $this->addCategory($post_data);
        }
        return $result;
    }

    protected function editCategory($post_data){
        $em = $this->getEntityManager();
        $result = 'Edit Category Failed.';

        /**@var \PtgTbCategory\Entity\Category $PtgTbCategory */
        $PtgTbCategory = $em->getRepository('\PtgTbCategory\Entity\Category')->findOneBy(
            array('id' => $post_data['select_category'])
        );

        $PtgTbCategory->title = $post_data['title'];
        $PtgTbCategory->slug = $post_data['slug'];
        $PtgTbCategory->image_directory = $post_data['image_directory'];
        $PtgTbCategory->main_pic_src = $post_data['main_pic_name'];
        $PtgTbCategory->subdescription = $post_data['subdescription'];
        $PtgTbCategory->description = $post_data['description'];

        $em->persist($PtgTbCategory);
        $em->flush();

        $result = "Category (#" . $PtgTbCategory->id . ") " . $PtgTbCategory->title . " Updated Successfully.";


        return $result;

    }

    protected function addCategory($post_data){

        $em = $this->getEntityManager();
        $result = 'Add Category Failed.';


        /**@var \PtgTbCategory\Entity\Category $PtgTbCategory */
        $PtgTbCategory = new \PtgTbCategory\Entity\Category();

        $PtgTbCategory->title = $post_data['title'];
        $PtgTbCategory->slug = $post_data['slug'];
        $PtgTbCategory->image_directory = $post_data['image_directory'];
        $PtgTbCategory->main_pic_src = $post_data['main_pic_name'];
        $PtgTbCategory->subdescription = $post_data['subdescription'];
        $PtgTbCategory->description = $post_data['description'];

        $em->persist($PtgTbCategory);
        $em->flush();

        $result = "Category (#" . $PtgTbCategory->id . ") " . $PtgTbCategory->title . " Added Successfully.";


        return $result;
    }

    public function addAction(){

        $this->getTitleInput();
        $this->getSlugInput();
        $this->getImgDirInput();
        $this->getMainPicNameInput();
        $this->getSubDescriptionInput();
        $this->getDescriptionInput();
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

                $this->getHiddenCategoryIdInput($c->id);
                $this->getTitleInput($c->title);
                $this->getSlugInput($c->slug);
                $this->getImgDirInput($c->image_directory);
                $this->getMainPicNameInput($c->main_pic_src);
                $this->getSubDescriptionInput($c->subdescription);
                $this->getDescriptionInput($c->description);
                $this->getSaveButton();

            }

        }

        return new ViewModel(array('inputs' => $this->inputs));
    }

    protected function getHiddenCategoryIdInput($cat_id) {
        $this->inputs[] = "<input type='hidden' name='select_category' id='select_category' value='$cat_id' />";
    }

    public function getSelectCategoryInput(){
        $em = $this->getEntityManager();

        $select = '<div class="form-group">
                <label for="select_category" class="col-sm-2 control-label">Select Category</label>
                <div class="col-sm-10">
                    <select class="form-control" id="select_category" name="select_category" size="20">
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
                    <textarea class="form-control" rows="6" id="description" name="description">'. $v .'</textarea>
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
              <button type="submit" class="btn btn-default">Next &raquo;</button>
            </div>
          </div>';
    }


}
