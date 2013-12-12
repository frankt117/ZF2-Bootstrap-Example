<?php
return array(
    'invokables' => array(
        'application_service_webrequest' => 'Application\Service\WebRequest'
    ),
    'factories' => array(
	'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
    ),
);