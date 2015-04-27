<?php

namespace Conference\Service;

use Conference\Entity\Conference;
use Conference\InputFilter\ConferenceInputFilter;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Form\Form;

class ConferenceService
{
    /**
     *
     * @var EntityManager
     */
    protected $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function getAll() {
        $repository = $this->em->getRepository('Conference\Entity\Conference');
        
        return $repository->findAll();
    }
    
    public function getById($id) {
        $repository = $this->em->getRepository('Conference\Entity\Conference');
        
        return $repository->find($id);
    }
    
    public function getByIdWithLieu($id) {
        $dql = "SELECT c, l FROM Conference\Entity\Conference LEFT JOIN c.lieu l WHERE c.id = :id";
        
        return $this->em->createQuery($dql)
                        ->setParameter('id', $id)
                        ->getSingleResult();
    }
    
    public function insert(Form $form, $dataAssoc) {
        $conference = new Conference();
        
        $hydrator = new DoctrineObject($this->em);
        
        $form->setHydrator($hydrator);        
        $form->bind($conference);
        $form->setInputFilter(new ConferenceInputFilter());
        $form->setData($dataAssoc);
        
        //var_dump($form->bind($conference));
        //exit();
        
        if (!$form->isValid()) {
            return null;
        }
        //var_dump($form->get('date_debut'));
        //exit();        
        
        $this->em->persist($conference);
        $this->em->flush();
        
        return $conference;
        
    }
    
    public function delete($id) {
        $conference = $this->em->find('Conference\Entity\Conference', $id);
       
        $this->em->remove($conference);
        $this->em->flush();
        
        return $conference;
    }
    
    public function update($id, Form $form, $dataAssoc) {
        $conference = $this->em->find('Conference\Entity\Conference', $id);
        
        $hydrator = new DoctrineObject($this->em);
        
        $form->setHydrator($hydrator);
        $form->bind($conference);
        $form->setInputFilter(new ConferenceInputFilter());
        $form->setData($dataAssoc);
        
        if (!$form->isValid()) {
            return null;
        }     
        
        $this->em->persist($conference);
        $this->em->flush();
        
        return $conference;
    }
    
}
