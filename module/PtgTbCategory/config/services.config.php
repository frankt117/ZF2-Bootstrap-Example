<?php
return array(
    'factories' => array(
        //doctrine.entitymanager.orm_default
        'ptgbase_doctrine_descriminatorlistener' => function ($sl) {

                $Configuration = $sl->get('doctrine.configuration.orm_default');
                return new PtgBase\Doctrine\DiscriminatorListener( $Configuration ) ;
            },
    )
);