<?php

return array(
    'invokables' => array(
        'ptguser_service_user' => 'PtgUser\Service\User'
    ),
    'factories' => array(
        // We alias this one because it's WdgUser's instance of
        // Zend\Authentication\AuthenticationService. We don't want to
        // hog the FQCN service alias for a Zend\* class.
        'ptguser_user_repos' => function ($sm) {
            return $sm->get('doctrine.entity_manager.orm_default')->getRepository("PtgUser\Entity\User");
        },
    )
);