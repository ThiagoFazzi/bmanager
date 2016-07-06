<?php
namespace Finance\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Model\ViewModel;
use Finance\Entity\StructureItem;
use Finance\Form\StructureItemForm;
use Finance\Validator\StructureItemValidator;

class StructureItemController extends AbstractActionController {

	protected $serviceLocator = null;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }	

	# Method for list all banks
	public function indexAction() {

		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$structureItemRepository = $entityManager->getRepository('Finance\Entity\StructureItem');
		$items = $structureItemRepository->findALL();

		$view_params = array(
			'items' => $items,
		);
		
		return new ViewModel($view_params);

	}

	# Method for insert bank
	public function registerAction() {
	
		if(!$user = $this->identity()) {
			return $this->redirect()->toUrl('/User/index');
		}
		
		$form = new StructureItemForm();

		if($this->request->isPost()){
			
			$name = $this->request->getPost('name');

			$item = new StructureItem($name);

			$structureItemValidator = new StructureItemValidator();

			$form->setInputFilter($structureItemValidator->getInputFilter());
			$form->setData($this->request->getPost());

			if($form->isValid()){
				
				$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
				$entityManager->persist($item);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage('Item cadastrado com sucesso!!');

				return $this->redirect()->toRoute('finance', array('controller' => 'StructureItem', 'action' => 'index'));
			}
		}

		return new ViewModel(['form' => $form]);
	}	

	# Method for update bank
	public function updateAction(){

		$id = $this->params()->fromRoute('id');
		
		if(is_null($id)){
			$id = $this->request->getPost('id');
		}

		$form = new StructureItemForm();

		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$structureItemRepository = $entityManager->getRepository('Finance\Entity\StructureItem');
		$item = $structureItemRepository->find($id);

		if($this->request->isPost()){
			$item->setName($this->request->getPost('name'));

			$entityManager->persist($item);
			$entityManager->flush();
   			
   			$this->flashMessenger()->addSuccessMessage("Item alterado com sucesso!");

			return $this->redirect()->toRoute('finance', array('controller' => 'StructureItem', 'action' => 'index'));

		}

		$view_params = array(
			'form' => $form,
			'item' => $item,
		);

		return new ViewModel($view_params);
	}	

	# Method for delete company
	public function deleteAction(){
		
		$id = $this->params()->fromRoute('id');
		if(is_null($id)){
			$id = $this->params()->fromPost('id');
		}

			
		$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$structureItemRepository = $entityManager->getRepository('Finance\Entity\StructureItem');
		$item = $structureItemRepository->find($id);

			if($this->request->isPost()){

				$entityManager->remove($item);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage("Item excluído com sucesso!");

				return $this->redirect()->toRoute('finance', array('controller' => 'StructureItem', 'action' => 'index'));

			}


		$view_params = ['item'=>$item];
		return new ViewModel($view_params);
	}

}