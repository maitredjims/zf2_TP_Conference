<?php

namespace Conference\InputFilter;

use Zend\InputFilter\InputFilter;

class ConferenceInputFilter extends InputFilter 
{

    public function __construct() {

        $input = new \Zend\InputFilter\Input('nom');

        $filter = new \Zend\Filter\StringTrim();
        $input->getFilterChain()->attach($filter);

        $filter = new \Zend\Filter\StripTags();
        $input->getFilterChain()->attach($filter);

        $validator = new \Zend\Validator\StringLength();
        $validator->setMax(40);
        $input->getValidatorChain()->attach($validator);

        $validator = new \Zend\Validator\NotEmpty();
        $input->getValidatorChain()->attach($validator);

        $this->add($input);
        
        $input = new \Zend\InputFilter\Input('descriptif');

        $filter = new \Zend\Filter\StringTrim();
        $input->getFilterChain()->attach($filter);

        $filter = new \Zend\Filter\StripTags();
        $input->getFilterChain()->attach($filter);

        $validator = new \Zend\Validator\StringLength();
        $validator->setMax(255);
        $input->getValidatorChain()->attach($validator);

        $validator = new \Zend\Validator\NotEmpty();
        $input->getValidatorChain()->attach($validator);

        $this->add($input);
        
//        $input = new \Zend\InputFilter\Input('date_debut');
                
//        $this->add($input);
        
        $input = new \Zend\InputFilter\Input('lieu_id');
        $input->setRequired(false);
        $this->add($input);
    }

}
