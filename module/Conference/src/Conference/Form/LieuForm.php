<?php

namespace Conference\Form;

class LieuForm extends \Zend\Form\Form
{
    public function __construct() {
        parent::__construct('lieu');
        
        $this->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods());
        
        $element = new \Zend\Form\Element\Text('nom');
        $element->setLabel('Nom de la salle :');
        $this->add($element);
        
        $element = new \Zend\Form\Element\Number('capacite');
        $element->setLabel('Capacité de la salle :');
        $this->add($element);
    }

}
