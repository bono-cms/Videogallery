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
            return $this->createForm($video, 'Edit the video');
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
        $service = $this->getModuleService('fileManager');

        // Batch removal
        if ($this->request->hasPost('toDelete')) {
            $ids = array_keys($this->request->getPost('toDelete'));

            $service->deleteByIds($ids);
            $this->flashBag->set('success', 'Selected elements have been removed successfully');

        } else {
            $this->flashBag->set('warning', 'You should select at least one element to remove');
        }

        // Single removal
        if (!empty($id)) {
            $service->deleteById($id);
            $this->flashBag->set('success', 'Selected element has been removed successfully');
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
        $input = $this->request->getAll();
        $data = $input['data']['video'];

        $formValidator = $this->createValidator(array(
            'input' => array(
                'source' => $data,
                'definition' => array(
                    'title' => new Pattern\Name(),
                    'description' => new Pattern\Description()
                )
            )
        ));

        if ($formValidator->isValid()) {
            $service = $this->getModuleService('fileManager');

            if (!empty($data['id'])) {
                if ($service->update($input)) {
                    $this->flashBag->set('success', 'The element has been updated successfully');
                    return '1';
                }

            } else {
                if ($service->add($input)) {
                    $this->flashBag->set('success', 'The element has been created successfully');
                    return $service->getLastId();
                }
            }

        } else {
            return $formValidator->getErrors();
        }
    }
}
