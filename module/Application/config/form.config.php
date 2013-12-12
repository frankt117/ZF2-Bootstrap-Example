<?php
return array(
    'factories' => array(
        'application_form_webrequest_getstarted' => function($sm){
            $form   = new \Application\Form\WebRequest\GetStarted();
            $filter = new \Application\Filter\WebRequest\GetStarted();

            return $form->setInputFilter($filter);
        }
    )
);