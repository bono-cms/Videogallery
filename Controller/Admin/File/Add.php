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

final class Add extends AbstractFile
{
    /**
     * Shows adding form
     * 
     * @return string
     */
    public function indexAction()
    {
        $this->loadSharedPlugins();
        $title = 'Add a video';
        
        return $this->viewModel->render($this->getTemplatePath(), $this->getSharedVars(array(
            'breadcrumbs' => array(
                '#' => $title
            ),
            
            'title' => $title
        )));
    }

    /**
     * Uploads a video file
     * 
     * @return string
     */
    public function addAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {
            
            if (1) {
                
                $fileManager = $this->getFileManager();
                $fileManager->add($this->getContainer());
                
                $this->flashMessenger->set('success', 'A video has been added successfully');
                
                return $fileManager->getLastId();
            
            } else {
                
                return $formValidator->getErrors();
            }
        }
    }
}
