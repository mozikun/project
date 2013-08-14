<?php
class oracle_viewController extends controller {
	public function showAction(){
		$this->view->display("show.html");
	}
}