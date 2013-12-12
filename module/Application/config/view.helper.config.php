<?php
return array(
    'factories' => array(
        'GFProductLinks' => function ($sm) {
            return new \Application\View\Helper\ProductLinks();
        },
    ),
);