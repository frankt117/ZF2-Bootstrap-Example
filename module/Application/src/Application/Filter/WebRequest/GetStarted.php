<?php
namespace Application\Filter\WebRequest;

use Zend\InputFilter\InputFilter;

class GetStarted extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'emailaddress',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty', 
                    'break_chain_on_failure' => true,  
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Email is required'
                        ),
                    )
                ),
                array(
                    'name' => 'EmailAddress', 
                    'break_chain_on_failure' => true,  
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Email is required'
                        ),
                    )
                )
            ),
        ));
        
        $this->add(array(
            'name' => 'message',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty', 
                    'break_chain_on_failure' => true,  
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Message is required'
                        ),
                    )
                ),
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 5,
                        'max' => 5000,
                        'messages' => array(
                            'stringLengthTooLong' => 'Message is too long. 5000 characters maximum. Sorry :('
                        )
                    ),
                )
            ),
        ));
    }
}

