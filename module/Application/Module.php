<?php
namespace Application;

class Module
{
    /**
     * include and return module config 
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}