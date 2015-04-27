<?php

namespace Conference\Service;

use Conference\Entity\Lieu;
use Conference\InputFilter\LieuInputFilter;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Form\Form;

class LieuService 
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
        $repository = $this->em->getRepository('Conference\Entity\Lieu');
        
        return $repository->findAll();
    }
    
    public function getById($id) {
        $repository = $this->em->getRepository('Conference\Entity\Lieu');
        
        return $repository->find($id);
    }
    
    public function insert(Form $form, $dataAssoc) {
        $lieu = new Lieu();
        
        $hydrator = new DoctrineObject($this->em);
        $form->setHydrator($hydrator);
        
        $form->bind($lieu);
        $form->setInputFilter(new LieuInputFilter());
        $form->setData($dataAssoc);
        
        if (!$form->isValid()) {
            return null;
        }
        
        $this->em->persist($lieu);
        $this->em->flush();
        
        return $lieu;
    }
    
    public function delete($id) {
       $lieu = $this->em->find('Conference\Entity\Lieu', $id);
       
       $this->em->remove($lieu);
       $this->em->flush();
       
       return $lieu;
    }
    
    public function update($id, Form $form, $dataAssoc) {
        $lieu = $this->em->find('Conference\Entity\Lieu', $id);
        
        $hydrator = new DoctrineObject($this->em);
        
        $form->setHydrator($hydrator);
        $form->bind($lieu);
        $form->setInputFilter(new LieuInputFilter());
        $form->setData($dataAssoc);
        
        if (!$form->isValid()) {
            return null;
        }     
        
        $this->em->persist($lieu);
        $this->em->flush();
        
        return $lieu;
    }
}
