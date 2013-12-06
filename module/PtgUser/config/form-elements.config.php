<?php
use PtgUser\Form;

return array(
    'factories' => array(
        'ptguser_edit_form' => function($sm){
            $form = new Form\User\Edit();

            $form->setInputFilter(new \PtgUser\Filter\User\Edit());

            return $form;
        },
        'ptguser_change_password_form' => function($sm){
            $form = new Form\User\ChangePassword();

            $form->setInputFilter(new \PtgUser\Filter\User\ChangePassword());

            return $form;
        },
        'ptguser_add_form' => function($sm){
            $form = new Form\User\Add();

            $form->setInputFilter(new \PtgUser\Filter\User\Add());

            return $form;
        },
    )
);