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
        $video = $this->moduleService('fileManager')->fetchById($id);

        if ($video !== false) {
            $title = 'Edit the file';

            $this->loadSharedPlugins();
            $this->loadBreadcrumbs($title);

            return $this->view->render('file.form', array(
                'title' => $title,
                'video' => $video
            ));
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
