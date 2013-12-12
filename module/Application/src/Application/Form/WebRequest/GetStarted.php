<?php
namespace Application\Form\WebRequest;

class GetStarted extends \PtgBase\Form\PostFormAbstract
{
    public function __construct()
    {
        parent::__construct();
        
        $this->add(array(
            'name' => 'emailaddress',
            'label' => 'Email Address',
        ));
        
        $this->add(array(
            'name' => 'phonenumber',
            'label' => 'Phone Number'
        ));
    }
}