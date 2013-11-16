<?php
return array(
    'zenddevelopertools' => array(
         /**
          * General Profiler settings
          */
        'profiler' => array(
            /**
             * Enables or disables the profiler.
             *
             * Expects: bool
             * Default: false
             */
            'enabled' => false,

            /**
             * If a matches is defined, the profiler will be disabled if the
             * request does not match the pattern.
             *
             * Example: 'matcher' => array('ip' => '127.0.0.1')
             *          OR
             *          'matcher' => array('url' => array('path' => '/admin')
             *
             * Note: The matcher is not implemented yet!
             */
            'matcher' => array('url' => array('path' => '/admin')),

            /**
             * Contains a list with all collector the profiler should run.
             * Zend Developer Tools ships with 'db' (Zend\Db), 'time', 'event', 'memory',
             * 'exception', 'request' and 'mail' (Zend\Mail). If you wish to disable a default
             * collector, simply set the value to null or false.
             *
             * Example: 'collectors' => array('db' => null)
             *
             * Expects: array
             */
            'collectors' => array(),
        ),
         /**
          * General Toolbar settings
          */
        'toolbar' => array(
            /**
             * Enables or disables the Toolbar.
             *
             * Expects: bool
             * Default: false
             */
            'enabled' => false,
        ),
    ),
);