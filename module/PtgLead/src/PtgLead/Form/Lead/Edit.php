<?php
namespace PtgLead\Form\Lead;

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
            'name' => 'name',
            'options' => array(
                'label' => 'Name',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));
    }
}