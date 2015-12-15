<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Videogallery\Controller\Admin\File;

final class Edit extends AbstractFile
{
	/**
	 * Shows edit form
	 * 
	 * @param string $id
	 * @return string
	 */
	public function indexAction($id)
	{
		$file = $this->getFileManager()->fetchById($id);
		
		if ($file !== false) {
			
			$this->loadSharedPlugins();
			$title = 'Edit the file';
			
			return $this->viewModel->render($this->getTemplatePath(), $this->getSharedVars(array(
				'breadcrumbs' => array(
					'#' => $title
				).
				
				'title' => $title
			)));
			
		} else {
			
			return false;
		}
	}

	/**
	 * Updates a file
	 * 
	 * @return string
	 */
	public function updateAction()
	{
		if ($this->request->isPost() && $this->request->isAjax()) {
			
			$formValidator = $this->getValidator();
			
			if (1) {
				
				$fileManager = $this->getFileManager();
				$fileManager->update($this->getContainer());
				
				$this->flashMessenger->set('success', 'A file has been updated successfully');
				
				return '1';
				
			} else {
				
				return $formValidator->getErrors();
			}
		}
	}
}
