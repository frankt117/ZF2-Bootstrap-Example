<?php
use PtgLead\Form;

return array(
    'factories' => array(
        'ptglead_edit_form' => function($sm){
            $form = new Form\Lead\Edit();

            $form->setInputFilter(new \PtgLead\Filter\Lead\Edit());

            return $form;
        },
        'ptglead_add_form' => function($sm){
            $form = new Form\Lead\Add();

            $form->setInputFilter(new \PtgLead\Filter\Lead\Add());

            return $form;
        },
    )
);