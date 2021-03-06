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
                            'emailAddressInvalid' => 'Please enter a valid email address',
                            'emailAddressInvalidFormat' => 'Please enter a valid email address',
                            'emailAddressInvalidHostname' => 'Please enter a valid email address',
                            'emailAddressInvalidMxRecord' => 'Please enter a valid email address',
                            'emailAddressInvalidSegment' => 'Please enter a valid email address',
                            'emailAddressDotAtom' => 'Please enter a valid email address',
                            'emailAddressQuotedString' => 'Please enter a valid email address',
                            'emailAddressInvalidLocalPart' => 'Please enter a valid email address',
                            'emailAddressLengthExceeded' => 'Please enter a valid email address',
                        ),
                    )
                )
            ),
        ));
        
        $this->add(array(
            'name' => 'description',
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
                            'isEmpty' => 'Description is required'
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
                            'stringLengthTooLong' => 'Description is too long. 5000 characters maximum. Sorry :('
                        )
                    ),
                )
            ),
        ));
    }
}

