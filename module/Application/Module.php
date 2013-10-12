<?php
namespace Application;

class Module
{
    public function getConfig()
    {
        $config         = array();
        $configFiles    = array(
            'module.config.php',
            'routes.config.php',
        );
        
        foreach ($configFiles as $configFile) 
        {
            $config = \Zend\Stdlib\ArrayUtils::merge($config, include __DIR__ . '/config/' . $configFile);
        }

        return $config;
    }
    
    /**
     * {@InheritDoc}
     */
    public function getControllerConfig() 
    {
        return include __DIR__ . '/config/controllers.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}