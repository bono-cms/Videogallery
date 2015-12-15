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

use Cms\Controller\Admin\AbstractController;
use stdclass;

final class Browser extends AbstractController
{
    /**
     * Shows a table
     * 
     * @param integer $page
     * @return string
     */
    public function indexAction($page = 1)
    {
        // Grab a module
        $module = $this->moduleManager->getModule('Videogallery');
        
        // Grab a service
        $fileManager = $module->getService('fileManager');
        
        return $this->view->render('browser', array(
            'breadcrumbs' => array(
                '#' => 'Videogallery'
            ),
            
            'files' => $fileManager->fetchAllByPage($page, 10),
            
            // Pagination stuff
            'paginator' => $fileManager->getPaginator(),
            'url'       => '',
        ));
    }

    /**
     * Filters by category and pagination
     * 
     * @param string $id
     * @param integer $page
     * @return string
     */
    public function categoryAction($id, $page = 1)
    {
        // Grab a service
        $fileManager = $this->moduleManager->getModule('Videogallery')->getService('fileManager');
        $records = $fileManager->fetchAllByCategoryIdAndPage($id, $page, 10);
        
        return $this->view->render('/layout/videogallery/browser.phtml', array(
            
            'records' => $records,
            
            'url' => '',
            'paginator' => $fileManager->getPaginator(),
        ));
    }

    /**
     * Deletes a file by its associated id from the table
     * 
     * @return string
     */
    public function deleteAction()
    {
        if ($this->request->hasPost('id') && $this->request->isAjax()) {
            $id = $this->request->getPost('id');
            // Grab a service
            $fileManager = $this->moduleManager->getModule('Videogallery')->getService('fileManager');
            $fileManager->deleteById($id);
            
            $this->flashMessenger->set('success', 'File has been removed successfully');
            
            return '1';
        }
    }

    /**
     * Delete selected records
     * 
     * @return string
     */
    public function deleteSelectedAction()
    {
        if ($this->request->hasPost('toDelete') && $this->request->isAjax()) {
            
            $ids = $this->request->getPost('toDelete');
            
            // Grab a service
            $fileManager = $this->moduleManager->getModule('Videogallery')->getService('fileManager');
            $fileManager->deleteByIds($ids);
            
            $this->flashMessenger->set('success', 'Selected files have been removed successfully');
            
            return '1';
        }
    }

    /**
     * Saves settings
     * 
     * @return string
     */
    public function saveAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {
            
        }
    }
}
