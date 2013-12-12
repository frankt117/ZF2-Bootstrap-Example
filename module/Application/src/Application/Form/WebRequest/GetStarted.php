<?php
namespace Application\Form\WebRequest;

class GetStarted extends \PtgBase\Form\PostFormAbstract
{
    public function __construct()
    {
        parent::__construct();
        
        $this->add(array(
            'name' => 'emailaddress',
            'options' => array(
                'label' => 'Email Address',
            ),
            'attributes' => array(
                'placeholder' => 'Your email address'
            )
        ));
        
        $this->add(array(
            'type' => '\Zend\Form\Element\Textarea',
            'name' => 'description',
            'options' => array(
                'label' => 'Description'
            ),
            'attributes' => array(
                'rows' => 3,
                'placeholder' => 'Tell us about the style and size of the building you want.'
            )
        ));
        
        $this->get('submit')->setLabel("Get your estimate!");
    }
}