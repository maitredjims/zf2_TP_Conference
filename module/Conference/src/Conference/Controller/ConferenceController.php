<?php

namespace Conference\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ConferenceController extends AbstractActionController
{
    /**
     *
     * @var \Zend\Http\Request
     */
    protected $request;

    /**
     *
     * @var \Conference\Service\ConferenceService
     */
    protected $conferenceService;
    
    /**
     *
     * @var \Conference\Service\LieuService
     */
    protected $lieuService;


    public function __construct(\Conference\Service\ConferenceService $conferenceService,  \Conference\Service\LieuService $lieuService) {
        $this->conferenceService = $conferenceService;
        $this->lieuService = $lieuService;
    }
    
    public function listAction() {
        
        $listeConferences = $this->conferenceService->getAll();
        
        return new ViewModel(array(
            'conferences' => $listeConferences
        ));
    }
    
    public function showAction()
    {
        
        $id = $this->params('id');
        
        $conference = $this->conferenceService->getById($id);
        
        if(!$conference) {
            // Génération d'une réponse d'erreur
            return $this->notFoundAction();
        }
        
        return new ViewModel(array(
            'conference' => $conference
        ));
    }
    
    public function addAction() {
        
        $form = new \Conference\Form\ConferenceForm();
        
        // Récupération des lieux
        $lieux = $this->lieuService->getAll();
        
        // On enregistre les lieux dans un tableau
        foreach ($lieux as $lieu) {
            $tablieux[$lieu->getId()] = $lieu->getNom();
        }
        
        //var_dump($tablieux);
        
        if($this->request->isPost()) {
            //$this->request->getPost()->date_debut = date_create_from_format('Y-m-d', $this->request->getPost()->date_debut);
            $conference = $this->conferenceService->insert($form, $this->request->getPost());
                        
            //var_dump($this->request->getPost());
            //exit();
            
            if($conference) {                
                return $this->redirect()->toRoute('conference');
            }
        }
        
        return new ViewModel(array(
            'form' => $form,
            'lieux' => $tablieux,
        ));
    }
    
    public function deleteAction() {
        $id = (int) $this->params('id');
        
        if(!$id) {
            return $this->redirect()->toRoute('conference');
        }
        
        if ($this->request->isPost()) {
            $del = $this->request->getPost('del', 'Non');

            if ($del == 'Oui') {
                $id = (int) $this->request->getPost('id');
                $this->conferenceService->delete($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('conference');
        }

        return array(
            'id' => $id,
            'conference' => $this->conferenceService->getById($id)
        );
        
        //return $this->redirect()->toRoute('conference');
    }
    
    public function updateAction() {
        
        $id = (int) $this->params('id');
        
        if(!$id) {
            return $this->redirect()->toRoute('conference');
        }
        
        $conference = $this->conferenceService->getById($id);
                
        $form = new \Conference\Form\ConferenceForm();
        $form->bind($conference);
        
        $lieux = $this->lieuService->getAll();
        
        // On enregistre les lieux dans un tableau
        foreach ($lieux as $lieu) {
            $tablieux[$lieu->getId()] = $lieu->getNom();
        }        
        
        if($this->request->isPost()) {
            $conference_update = $this->conferenceService->update($id, $form, $this->request->getPost());
            
            if($conference_update) {
                return $this->redirect()->toRoute('conference');
            }
        }
        
        return new ViewModel(array(
            'form' => $form,
            'lieux' => $tablieux,
        ));
    }
       
    
}
