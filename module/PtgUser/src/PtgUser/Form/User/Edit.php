<?php
namespace PtgUser\Form\User;

use PtgBase\Form\PostFormAbstract;

class Edit extends PostFormAbstract
{
    public function __construct()
    {
        parent::__construct();

        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
            'attributes' => array(
                'type' => 'hidden'
            ),
        ));

        $this->add(array(
            'name' => 'username',
            'options' => array(
                'label' => 'Username',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'options' => array(
                'label' => 'Email',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));

        $this->add(array(
            'name' => 'display_name',
            'options' => array(
                'label' => 'Display Name',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));    
        
        $this->add(array(
	    'type' => 'Zend\Form\Element\Radio',
            'name' => 'state',
            'options' => array(
                'label' => 'State',
                'value' => 1,
                'value_options' => array(
		    0 => "Off", 1 => "On"
		)
            ),
            'attributes' => array(
                'type' => 'select',
            ),
        ));
    }
}