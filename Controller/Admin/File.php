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
            'video' => $video
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
        $video->setPublished(true);

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
        $video = $this->moduleService('fileManager')->fetchById($id);

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
            // @TODO
        }
    }

    /**
     * Deletes a video file by its associated id
     * 
     * @return string
     */
    public function deleteAction()
    {
        // Batch removal
        if ($this->request->hasPost('toDelete') && $this->request->isAjax()) {
            $ids = $this->request->getPost('toDelete');

            // Grab a service
            $fileManager = $this->getModuleService('fileManager');
            $fileManager->deleteByIds($ids);

            $this->flashMessenger->set('success', 'Selected files have been removed successfully');
        }

        // Single removal
        if ($this->request->hasPost('id') && $this->request->isAjax()) {
            $id = $this->request->getPost('id');

            // Grab a service
            $fileManager = $this->getModuleService('fileManager');
            $fileManager->deleteById($id);

            $this->flashMessenger->set('success', 'File has been removed successfully');
        }

        return '1';
    }

    /**
     * Persists a file
     * 
     * @return string
     */
    public function saveAction()
    {
        $input = $this->request->getPost('file');

        $formValidator = $this->validatorFactory->build(array(
            'input' => array(
                'source' => $input,
                'definition' => array(
                    'title' => new Pattern\Name(),
                    'description' => new Pattern\Description()
                )
            )
        ));
        
        if ($formValidator->isValid()) {
            $fileManager = $this->getFileManager();

            if ($input['id']) {
                $fileManager->update($input);
                $this->flashMessenger->set('success', 'A file has been updated successfully');
                return '1';

            } else {
                $fileManager->add($input);

                $this->flashMessenger->set('success', 'A video has been added successfully');
                return $fileManager->getLastId();
            }
        } else {
            return $formValidator->getErrors();
        }
    }
}
