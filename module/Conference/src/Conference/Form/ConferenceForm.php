<?php

namespace Conference\Form;

class ConferenceForm extends \Zend\Form\Form
{
    public function __construct() {
        parent::__construct('conference');
        
        // Gestion de l'arrayCopy
        $this->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods());
        
        $element = new \Zend\Form\Element\Text('nom');
        $element->setLabel('Nom de la conférence :');
        $this->add($element);
                
        $element = new \Zend\Form\Element\Textarea('descriptif');
        $element->setLabel('Description de la conférence :');
        $this->add($element);
        
        $element = new \Zend\Form\Element\DateTime('date_debut');
        $element->setLabel('Date de début');
        $element->setFormat('Y-m-d');
        $this->add($element);
        
        $element = new \Zend\Form\Element\Select('lieu_id');
        $element->setLabel('Lieu de la conférence :');
        $element->setDisableInArrayValidator(true);
        $this->add($element);
    }
}
