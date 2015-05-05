<?php

namespace Conference\Form;

use Doctrine\ORM\EntityManager;
use Zend\Form\Form;

class ConferenceForm extends Form {

    protected $entityManager;

    public function __construct(EntityManager $entityManager) {
        parent::__construct('conference');

        $this->entityManager = $entityManager;

        // Gestion de l'arrayCopy
        $this->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods());

        $element = new \Zend\Form\Element\Text('nom');
        $element->setLabel('Nom de la conférence :');
        $this->add($element);

        $element = new \Zend\Form\Element\Textarea('descriptif');
        $element->setLabel('Description de la conférence :');
        $this->add($element);

        $element = new \Zend\Form\Element\DateTime('dateDebut');
        $element->setLabel('Date de début :');
        //$element->setValue(date('Y-m-d'));
//        $element->setOptions(array(
//            'format' => 'Y-m-d',
//        ));
        $element->setFormat('Y-m-d');
        $this->add($element);


//        $element = new \Zend\Form\Element\Select('lieu_id');
//        $element->setLabel('Lieu de la conférence :');
//        $element->setDisableInArrayValidator(true);
//        $this->add($element);

        $element = new \DoctrineModule\Form\Element\ObjectSelect('lieu');
        $element->setDisableInArrayValidator(true);
        $element->setOptions(array(
            'object_manager'     => $this->entityManager,
            'label' => 'Lieu de la conférence :',
            'target_class' => 'Conference\Entity\Lieu',
            // Property => nom du champ qu'on souhaite, ici le nom des lieux qu'on souhaite rajouter au Select
            'property' => 'nom',
            'is_method' => true,
            'find_method' => array(
                'name' => 'getLieu',
            ),
        ));
        $this->add($element);

//        $this->add(array(
//           'name' => 'lieu_id',
//           'type' => 'DoctrineModule\Form\Element\ObjectSelect',
//           'options' => array(
//               'label' => 'Lieu de la conférence',
//               'target_class' => 'Conference\Entity\Lieu',
//               'property' => 'lieu_id',
//               'is_method' => true,
//               'find_method' => array(
//                   'name' => 'getLieu',
//               ),
//           ),
//       ));
    }

    /*
      public function init() {
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

      $this->add(array(
      'name' => 'lieu_id',
      'type' => 'DoctrineModule\Form\Element\ObjectSelect',
      'options' => array(
      'object_manager' => $this->entityManager,
      'label' => 'Lieu de la conférence',
      'target_class' => 'Conference\Entity\Lieu',
      'property' => 'nom',
      'is_method' => true,
      'find_method' => array(
      'name' => 'getLieu',
      ),
      ),
      ));
      }
     */
}
