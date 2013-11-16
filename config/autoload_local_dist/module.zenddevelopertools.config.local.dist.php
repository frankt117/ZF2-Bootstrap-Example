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
            'enabled' => true,

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
            'matcher' => array('url' => array('path' => '/wdg-admin')),
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
            'enabled' => true,
        ),
    ),
);