<?php
namespace TbAdmin\Controller;

use TbAdmin\Controller\AbstractController,
    Zend\View\Model\ViewModel;

class ProductController extends AbstractController
{
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

        if($post_data['categories']){

            $Categories_updated = \Doctrine\Common\Collections\ArrayCollection();

            foreach ($post_data['categories'] as $category){

                $category   = $em->getRepository('\PtgTbCategory\Entity\Category')->findOneBy(
                    array('id' => $category)
                );

                if ($category instanceof \PtgTbCategory\Entity\Category){
                    $Categories_updated->add($category);
                }


            }

            $PtgTbProduct->Categories = $Categories_updated;

        }

        $em->persist($PtgTbProduct);
        $em->flush();

        $result = "Product (#" . $PtgTbProduct->id . ") " . $PtgTbProduct->name . " Updated Successfully.";


        return $result;

    }

    protected function addProduct($post_data){

        $em = $this->getEntityManager();
        $result = 'Add Product Failed.';

        /**@var \PtgTbProduct\Entity\Product $PtgTbProduct */
        $PtgTbProduct = new \PtgTbProduct\Entity\Product();

        $PtgTbProduct->name = $post_data['name'];
        $PtgTbProduct->slug = $post_data['slug'];
        $PtgTbProduct->price = $post_data['price'];
        $PtgTbProduct->image_directory = $post_data['image_directory'];
        $PtgTbProduct->main_pic_src = $post_data['main_pic_name'];
        $PtgTbProduct->subdescription = $post_data['subdescription'];
        $PtgTbProduct->description = $post_data['description'];

        if($post_data['categories']){

            foreach ($post_data['categories'] as $category){

                $category   = $em->getRepository('\PtgTbCategory\Entity\Category')->findOneBy(
                    array('id' => $category)
                );

                if ($category instanceof \PtgTbCategory\Entity\Category){
                    $PtgTbProduct->addCategory($category);
                }


            }
        }



        $em->persist($PtgTbProduct);
        $em->flush();

        $result = "Product (#" . $PtgTbProduct->id . ") " . $PtgTbProduct->name . " Added Successfully.";


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
        $this->getSelectCategoryInput();
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
                $this->getSelectCategoryInput($c->Categories);
                $this->getSaveButton();

            }

        }

        return new ViewModel(array('inputs' => $this->inputs));
    }

    protected function getHiddenProductIdInput($cat_id) {
        $this->inputs[] = "<input type='hidden' name='select_product' id='select_product' value='$cat_id' />";
    }

    public function getSelectCategoryInput($v = null){

        if($v instanceof \Doctrine\Common\Collections\Collection){
            $v = $v->getValues();
        }

        $em = $this->getEntityManager();

        $select = '<div class="form-group">
                <label for="select_main_category" class="col-sm-2 control-label">Select Main Category</label>
                <div class="col-sm-10">

                    ';

        foreach($em->getRepository('\PtgTbCategory\Entity\Category')->findAll() as $category){
            $select .= '<input type="checkbox" id="select_categories" name="categories[]" ';

            if(is_array($v)) $select .= in_array($category, $v) ? ' checked ' : '';

            $select .='value="' . $category->id . '">' . $category->title .'<br/>';
        }

        $select .=    '
                </div>
            </div>';

        $this->inputs[] = $select;
    }

    public function getSelectSubCategoryInput($v = 2){
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
                    <select class="form-control" id="select_product" name="select_product" size="20">
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
                    <input type="text" class="form-control" id="name" name="name" placeholder="A-Frame Carport" ';

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
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="a-frame-carport"';
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
                    <input type="text" class="form-control" id="image_directory" name="image_directory" placeholder="carports"';
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
                    <input type="text" class="form-control" id="main_pic_name" name="main_pic_name" placeholder="aframe.jpg"';
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
                    <input type="text" class="form-control" id="subdescription" name="subdescription" placeholder="The affordable way to protect your vehicle from the elements with a traditional look."';
        if($v) $subdesc .= 'value ="' . $v .'" ';

        $subdesc .= ' >
                </div>
            </div>';

        $this->inputs[] = $subdesc;
    }

    public function getDescriptionInput($v = ''){

        if ($v == ''){
            $v = 'Our A Frame style offers the more traditional look and feel for your carport. From being 100% '
                . 'American made, to offering a 10 year warranty, we are positive we can build the perfect A Frame '
                . 'carport for your needs. Contact us today for pricing and details.';
        }

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
