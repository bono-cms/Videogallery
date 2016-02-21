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
use Krystal\Validate\Pattern;
use Krystal\Stdlib\VirtualEntity;

final class File extends AbstractController
{
    /**
     * Creates a form
     * 
     * @param \Krystal\Stdlib\VirtualEntity $file
     * @param string $title
     * @return string
     */
    private function createForm(VirtualEntity $video, $title)
    {
        // Load view plugins
        $this->view->getPluginBag()
                   ->load($this->getWysiwygPluginName());

        // Append breadcrumbs
        $this->view->getBreadcrumbBag()
                   ->addOne('Videogallery', 'Videogallery:Admin:Browser@indexAction')
                   ->addOne($title);

        return $this->view->render('file.form', array(
            'video' => $video,
            'categories' => $this->getModuleService('categoryManager')->fetchAllAsTree()
        ));
    }

    /**
     * Renders empty form
     * 
     * @return string
     */
    public function addAction()
    {
        $video = new VirtualEntity();
        $video->setPublished(true)
              ->setSeo(true);

        return $this->createForm($video, 'Add a video');
    }

    /**
     * Renders edit form
     * 
     * @param string $id
     * @return string
     */
    public function editAction($id)
    {
        $video = $this->getModuleService('fileManager')->fetchById($id);

        if ($video !== false) {
            return $this->createForm($video, 'Edit the file');
        } else {
            return false;
        }
    }

    /**
     * Saves settings
     * 
     * @return string
     */
    public function tweakAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {

            $orders = $this->request->getPost('order');
            $published = $this->request->getPost('published');
            $seo = $this->request->getPost('seo');

            $fm = $this->getModuleService('fileManager');
            $fm->updateOrders($orders);
            $fm->updatePublished($published);
            $fm->updateSeo($seo);

            $this->flashBag->set('success', 'Settings have been updated successfully');
            return '1';
        }
    }

    /**
     * Deletes a video file by its associated id
     * 
     * @return string
     */
    public function deleteAction()
    {
        return $this->invokeRemoval('fileManager');
    }

    /**
     * Persists a file
     * 
     * @return string
     */
    public function saveAction()
    {
        $input = $this->request->getAll();
        $data = $input['data']['video'];

        return $this->invokeSave('fileManager', $data['id'], $input, array(
            'input' => array(
                'source' => $data,
                'definition' => array(
                    'title' => new Pattern\Name(),
                    'description' => new Pattern\Description()
                )
            )
        ));
    }
}
