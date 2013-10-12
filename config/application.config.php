<?php
/**
 * This config file defines which modules the application uses, how the Module 
 * Manager can find modules, how the rest of the configuration for the 
 * application can be found and is the config used to initialize the 
 * MVC Application object and its dependencies. Further options are available for more
 * advanced functionality such as Service Manager configuration, but are left out for clarity.
 */
return array(
    
    /**
     * List the modules the module manager will load.
     *
     * Modules are named via Namespace. Here we are requiring
     * a module with namespace Application.
     */
    'modules' => array(
        'Application',
    ),

    /**
     * Provide configuration to the Module Manager (code responsible
     * for loading modules)
     *
     * If there are Namespaces that have not already been autoloaded then the
     * Module Manager will need to know where abouts on the file system to look for them. 
     */
    'module_listener_options' => array(
        /**
         * Module Paths for module discovery
         * These path values depend on how the front controller has initialized this 
         * environment. Typically we have changed into the root directory.
         * This allows the module paths to be specified relatively.Here we are specifying 
         * that modules live in a folder called module and a folder called vendor in the 
         * root folder (up one directory level from public)
         */
        'module_paths' => array(
            './module',
            './vendor',
        ),

        /**
         * Next we define how the configuration for the rest of the Application should 
         * be generated and retrieved.
         *
         * ZF2 does not use Application Environment to alternate between configurations
         * by default. Instead it is recomended that a global configuration file is 
         * utilized for all common configuration, and a local configuration file is used
         * for implementation specific configuration (that is normally not wanted in Version
         * Control)
         *
         * Globbing essentially means apply pattern matching to a directory structure.
         * Here we define the pattern used to retrieve our config files, which will be merged
         * into a single configuration.
         */
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
    ),
);
