<?php

namespace Conference\Factory\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Conference\Form\ConferenceForm;

class ConferenceFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {
        
        $service = $serviceLocator->getServiceLocator();
        $entityManager = $service->get('Doctrine\ORM\EntityManager');
        
        $form = new ConferenceForm($entityManager);
        
        return $form;
    }
}
