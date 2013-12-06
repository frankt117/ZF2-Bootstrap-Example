<?php
namespace PtgLead\Filter\Lead;

use Zend\InputFilter\InputFilter;

class Edit extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'name',
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
                            'isEmpty' => 'Name is required'
                        ),
                    )
                ),
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 0,
                        'max' => 255,
                        'messages' => array(
                            'stringLengthTooLong' => 'Name is too long. 255 characters maximum'
                        )
                    ),
                )
            ),
        ));
        
        $this->add(array(
            'name' => 'id',
            'required' => false,
            'filters' => array(
                array('name' => 'Int'),
            ),
        ));
    }
}

