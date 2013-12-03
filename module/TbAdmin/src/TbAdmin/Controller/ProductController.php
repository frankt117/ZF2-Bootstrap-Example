<?php
namespace TbAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

class ProductController extends AbstractActionController
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
        $this->getSelectProductInput();
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
        if ($post_data['select_product']){ //edit mode
            $result = $this->editProduct($post_data);
        }
        else {                              // new addition
            $result = $this->addProduct($post_data);
        }
        return $result;
    }

    protected function editProduct($post_data){
        $em = $this->getEntityManager();
        $result = 'Edit Product Failed.';
        if($post_data['add_edit_password'] == 'M@dMoney'){
            /**@var \PtgTbProduct\Entity\Product $PtgTbProduct */
            $PtgTbProduct = $em->getRepository('\PtgTbProduct\Entity\Product')->findOneBy(
                array('id' => $post_data['select_product'])
            );

            $PtgTbProduct->name = $post_data['name'];
            $PtgTbProduct->slug = $post_data['slug'];
            $PtgTbProduct->price = $post_data['price'];
            $PtgTbProduct->image_directory = $post_data['image_directory'];
            $PtgTbProduct->main_pic_src = $post_data['main_pic_name'];
            $PtgTbProduct->subdescription = $post_data['subdescription'];
            $PtgTbProduct->description = $post_data['description'];
            $PtgTbProduct->main_category = $post_data['main_category'];
            $PtgTbProduct->sub_category = $post_data['sub_category'];

            $em->persist($PtgTbProduct);
            $em->flush();

            $result = "Product (#" . $PtgTbProduct->id . ") " . $PtgTbProduct->name . " Updated Successfully.";
        }

        return $result;

    }

    protected function addProduct($post_data){

        $em = $this->getEntityManager();
        $result = 'Add Product Failed.';

        if($post_data['add_edit_password'] == 'M@dMoney'){
            /**@var \PtgTbProduct\Entity\Product $PtgTbProduct */
            $PtgTbProduct = new \PtgTbProduct\Entity\Product();

            $PtgTbProduct->name = $post_data['name'];
            $PtgTbProduct->slug = $post_data['slug'];
            $PtgTbProduct->price = $post_data['price'];
            $PtgTbProduct->image_directory = $post_data['image_directory'];
            $PtgTbProduct->main_pic_src = $post_data['main_pic_name'];
            $PtgTbProduct->subdescription = $post_data['subdescription'];
            $PtgTbProduct->description = $post_data['description'];
            $PtgTbProduct->main_category = $post_data['main_category'];
            $PtgTbProduct->sub_category = $post_data['sub_category'];

            $em->persist($PtgTbProduct);
            $em->flush();

            $result = "Product (#" . $PtgTbProduct->id . ") " . $PtgTbProduct->name . " Added Successfully.";
        }

        return $result;
    }

    public function addAction(){

        $this->getNameInput();
        $this->getSlugInput();
        $this->getPriceInput();
        $this->getImgDirInput();
        $this->getMainPicNameInput();
        $this->getSubDescriptionInput();
        $this->getDescriptionInput();
        $this->getSelectMainCategoryInput();
        $this->getSelectSubCategoryInput();
        $this->getAddEditPasswordInput();
        $this->getSaveButton();

        return new ViewModel(array('inputs' => $this->inputs));
    }

    public function editAction(){

        $em = $this->getEntityManager();
        $request = $this->getRequest();

        if($request->isPost()){

            $post_data = $request->getPost();
            $c   = $em->getRepository('\PtgTbProduct\Entity\Product')->findOneBy(array('id' => $post_data['select_product']));
            if($c instanceof \PtgTbProduct\Entity\Product){

                $this->getHiddenProductIdInput($c->id);
                $this->getNameInput($c->name);
                $this->getPriceInput($c->price);
                $this->getSlugInput($c->slug);
                $this->getImgDirInput($c->image_directory);
                $this->getMainPicNameInput($c->main_pic_src);
                $this->getSubDescriptionInput($c->subdescription);
                $this->getDescriptionInput($c->description);
                $this->getSelectMainCategoryInput($c->main_category);
                $this->getSelectSubCategoryInput($c->sub_category);
                $this->getAddEditPasswordInput();
                $this->getSaveButton();

            }

        }

        return new ViewModel(array('inputs' => $this->inputs));
    }

    protected function getHiddenProductIdInput($cat_id) {
        $this->inputs[] = "<input type='hidden' name='select_product' id='select_product' value='$cat_id' />";
    }

    public function getSelectMainCategoryInput($v = ''){
        $em = $this->getEntityManager();

        $select = '<div class="form-group">
                <label for="select_main_category" class="col-sm-2 control-label">Select Main Category</label>
                <div class="col-sm-10">
                    <select class="form-control" id="select_main_category" name="main_category">
                    ';

        foreach($em->getRepository('\PtgTbCategory\Entity\Category')->findAll() as $category){
            $select .= '<option ';

            $select .= $v == $category->id ? ' selected ' : '';

            $select .='value="' . $category->id . '">' . $category->title .'</option>';
        }

        $select .=    '</select>
                </div>
            </div>';

        $this->inputs[] = $select;
    }

    public function getSelectSubCategoryInput($v =''){
        $em = $this->getEntityManager();

        $select = '<div class="form-group">
                <label for="select_sub_category" class="col-sm-2 control-label">Select Subcategory</label>
                <div class="col-sm-10">
                    <select class="form-control" id="select_sub_category" name="sub_category">
                    ';

        foreach($em->getRepository('\PtgTbCategory\Entity\Category')->findAll() as $category){
            $select .= '<option ';

            $select .= $v == $category->id ? ' selected ' : '';

            $select .='value="' . $category->id . '">' . $category->title .'</option>';
        }

        $select .=    '</select>
                </div>
            </div>';

        $this->inputs[] = $select;
    }

    public function getSelectProductInput(){
        $em = $this->getEntityManager();

        $select = '<div class="form-group">
                <label for="select_product" class="col-sm-2 control-label">Select Product</label>
                <div class="col-sm-10">
                    <select class="form-control" id="select_product" name="select_product">
                    ';

            foreach($em->getRepository('\PtgTbProduct\Entity\Product')->findAll() as $product){
                $select .= '<option value="' . $product->id . '">' . $product->name .'</option>';
            }

        $select .=    '</select>
                </div>
            </div>';

        $this->inputs[] = $select;
    }

    public function getNameInput($v = ''){
        $name = '<div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Horse Barn" ';

        if($v) $name .= 'value ="' . $v .'" ';

        $name .= ' >
                </div>
            </div>';

        $this->inputs[] = $name;
    }

    public function getPriceInput($v = ''){
        $price = '<div class="form-group">
                <label for="name" class="col-sm-2 control-label">Price</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="price" name="price" placeholder="11000" ';

        if($v) $price .= 'value ="' . $v .'" ';

        $price .= ' >
                </div>
            </div>';

        $this->inputs[] = $price;
    }

    public function getSlugInput($v = ''){
        $slug = '<div class="form-group">
                <label for="slug" class="col-sm-2 control-label">Slug</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="horse-barn"';
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
                    <input type="text" class="form-control" id="main_pic_name" name="main_pic_name" placeholder="horse-barn1.jpg"';
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
                    <input type="text" class="form-control" id="subdescription" name="subdescription" placeholder="The perfect mix of protection and western style for your horse barning needs son!"';
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
              <button type="submit" class="btn btn-default">Next &raquo;</button>
            </div>
          </div>';
    }


}
