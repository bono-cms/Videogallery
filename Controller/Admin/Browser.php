<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Videogallery\Controller\Admin;

use Cms\Controller\Admin\AbstractController;

final class Browser extends AbstractController
{
    /**
     * Shows a grid
     * 
     * @param integer $page
     * @return string
     */
    public function indexAction($page = 1)
    {
        $this->loadBreadcrumbs();

        $fileManager = $this->getModuleService('fileManager');
        $files = $fileManager->fetchAllByPage($page, $this->getSharedPerPageCount(), false);

        // Tweak pagination
        $paginator = $fileManager->getPaginator();
        $paginator->setUrl('/admin/module/videogallery/page/(:var)');

        return $this->view->render('browser', array(
            'title' => 'Videogallery',
            'files' => $files,
            'paginator' => $fileManager->getPaginator()
        ));
    }

    /**
     * Shows a grid filtered by category id
     * 
     * @param string $id Category id
     * @param integer $page Current page number
     * @return string
     */
    public function categoryAction($id, $page = 1)
    {
        $this->loadBreadcrumbs();

        $fileManager = $this->getModuleService('fileManager');
        $files = $fileManager->fetchAllByCategoryIdAndPage($id, $page, $this->getSharedPerPageCount());

        // Tweak pagination
        $paginator = $this->getPaginator();
        $paginator->setUrl(sprintf('/admin/module/videogallery/category/%s/page/(:var)', $id));

        return $this->view->render('browser', array(
            'files' => $files,
            'paginator' => $fileManager->getPaginator(),
            'title' => 'Videogallery'
        ));
    }

    /**
     * Deletes a video file by its associated id
     * 
     * @return string
     */
    public function deleteAction()
    {
        if ($this->request->hasPost('id') && $this->request->isAjax()) {
            $id = $this->request->getPost('id');

            // Grab a service
            $fileManager = $this->getModuleService('fileManager');
            $fileManager->deleteById($id);

            $this->flashMessenger->set('success', 'File has been removed successfully');
            return '1';
        }
    }

    /**
     * Delete selected videos by their associated ids
     * 
     * @return string
     */
    public function deleteSelectedAction()
    {
        if ($this->request->hasPost('toDelete') && $this->request->isAjax()) {
            $ids = $this->request->getPost('toDelete');

            // Grab a service
            $fileManager = $this->getModuleService('fileManager');
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
    
    /**
     * Load breadcrumbs in view
     * 
     * @return void
     */
    private function loadBreadcrumbs()
    {
        $this->view->getBreadcrumbBag()
                   ->addOne('Videogallery');
    }
}
