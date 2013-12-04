<?php
namespace Application\Factory\Db;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ZendAdapterFactory implements FactoryInterface
{

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Configuration');
        if(!isset($config['db'])){
            return false;
        }
        if(class_exists('BjyProfiler\Db\Adapter\ProfilingAdapter')){
            $adapter = new BjyProfiler\Db\Adapter\ProfilingAdapter($config['db']);
            $adapter->setProfiler(new BjyProfiler\Db\Profiler\Profiler);
            if (isset($config['db']['options']) && is_array($config['db']['options'])) {
                $options = $config['db']['options'];
            } else {
                $options = array();
            }
            $adapter->injectProfilingStatementPrototype($options);
        } else {
            $adapter = new Zend\Db\Adapter\Adapter($config['db']);
        }
        return $adapter;
    }
}