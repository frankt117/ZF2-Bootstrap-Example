<?php
namespace WdgBlog\Form\Blog\Post;

class Add extends Base
{
    public function __construct(\PtgUser\Service\User $User)
    {
        parent::__construct($User);
    }
}