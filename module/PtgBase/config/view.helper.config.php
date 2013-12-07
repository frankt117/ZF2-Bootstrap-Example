<?php
return array(
    'factories' => array(
        'ptgMatchedRoute' => function ($sm) {
            return new \PtgBase\View\Helper\MatchedRoute();
        },
    ),
);