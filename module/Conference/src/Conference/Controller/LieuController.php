<?php

namespace Conference\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LieuController extends AbstractActionController
{
    /**
     *
     * @var \Conference\Service\LieuService
     */
    protected $lieuService;
    
    /**
     *
     * @var \Zend\Http\Request
     */
    protected $request;


    public function __construct(\Conference\Service\LieuService $lieuService) {
        $this->lieuService = $lieuService;
    }
    
    public function listAction() {
        
        $listLieux = $this->lieuService->getAll();
        
        return new ViewModel(array(
            'listLieux' => $listLieux
        ));
    }
    
    public function showAction() {
        $id = $this->params('id');
        
        $lieu = $this->lieuService->getById($id);
        
        if(!$lieu) {
            // Génération d'une réponse d'erreur
            return $this->notFoundAction();
        }
        
        return new ViewModel(array(
            'lieu' => $lieu
        ));
    }
    
    public function addAction() {
        
        $form = new \Conference\Form\LieuForm();
        
        if($this->request->isPost()) {
            $lieu = $this->lieuService->insert($form, $this->request->getPost());
            
            if($lieu) {
                return $this->redirect()->toRoute('lieu');
            }
        }
        
        return new ViewModel(array(
            'form' => $form
        ));
    }
    
    public function deleteAction() {
        $id = (int) $this->params('id');
        
        if(!$id) {
            return $this->redirect()->toRoute('lieu');
        }
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                $id = (int) $request->getPost('id');
                $this->lieuService->delete($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('lieu');
        }

        return array(
            'id' => $id,
            'lieu' => $this->lieuService->getById($id)
        );
        
        //return $this->redirect()->toRoute('lieu');
    }
    
    public function updateAction() {
        $id = (int) $this->params('id');
        
        if(!$id) {
            return $this->redirect()->toRoute('lieu');
        }
        
        $lieu = $this->lieuService->getById($id);
        
        $form = new \Conference\Form\LieuForm();
        $form->bind($lieu);
        
        if($this->request->isPost()) {
            $lieu_update = $this->lieuService->update($id, $form, $this->request->getPost());
            
            if($lieu_update) {
                return $this->redirect()->toRoute('lieu');
            }
        }
        
        return array(
            'form' => $form
        );
    }
}
