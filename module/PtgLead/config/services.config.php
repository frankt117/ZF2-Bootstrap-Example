<?php

return array(
    'invokables' => array(
        'ptglead_service_lead' => 'PtgLead\Service\Lead'
    ),
    'factories' => array(
        'ptglead_lead_repos' => function ($sm) {
            return $sm->get('doctrine.entity_manager.orm_default')->getRepository("PtgLead\Entity\Lead");
        },
    )
);