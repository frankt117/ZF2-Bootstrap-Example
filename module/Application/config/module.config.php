<?php
return array(
    //View manager configuration can be specified via the 'view_manager' key
    'view_manager' => array(
        //the template path stack is a record of all the places to look for templates
        'template_path_stack' => array(
            //here we specify templates can be found in the module/Application/views folder.
            __DIR__.'/../views/',
        ),
    ),
);
