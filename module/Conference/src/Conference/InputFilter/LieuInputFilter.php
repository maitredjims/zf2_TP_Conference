<?php

namespace Conference\InputFilter;

class LieuInputFilter extends \Zend\InputFilter\InputFilter
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
        
        $input = new \Zend\InputFilter\Input('capacite');

        $filter = new \Zend\Filter\StringTrim();
        $input->getFilterChain()->attach($filter);

        $filter = new \Zend\Filter\StripTags();
        $input->getFilterChain()->attach($filter);
        
        $validator = new \Zend\Validator\StringLength();
        $validator->setMax(5);
        $input->getValidatorChain()->attach($validator);

        $validator = new \Zend\Validator\GreaterThan();
        $validator->setMin(0);
        $input->getValidatorChain()->attach($validator);

        $validator = new \Zend\Validator\NotEmpty();
        $input->getValidatorChain()->attach($validator);

        $this->add($input);
    }

}
