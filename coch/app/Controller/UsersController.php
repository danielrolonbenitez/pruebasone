<?php
App::uses("PanelController", "Controller");


class UsersController extends PanelController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add');
	}
	
	public function add() {
		if($this->request->is('post')) {
			$this->User->create();
			if($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}
	
	public function login() {
		if($this->request->is('post') || $this->request->is('put')) {
			if($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			}
			else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		}
	}
	public function logout() {
		$this->redirect($this->Auth->logout());
	}
}