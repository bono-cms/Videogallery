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

final class Category extends AbstractController
{
    /**
     * Returns a tree with an empty prompt
     * 
     * @return array
     */
    private function getTree()
    {
        $text = sprintf('— %s —', $this->translator->translate('None'));
        return $this->getModuleService('categoryManager')->fetchAllAsTreeWithPromt($text);
    }

    /**
     * Creates a form
     * 
     * @param \Krystal\Stdlib\VirtualEntity $category
     * @param string $title
     * @return string
     */
    private function createForm(VirtualEntity $category, $title)
    {
        // Append breadcrumbs
        $this->view->getBreadcrumbBag()
                   ->addOne('Videogallery', 'Videogallery:Admin:Browser@indexAction')
                   ->addOne($title);

        // Load view plugins
        $this->view->getPluginBag()->appendScript('@Videogallery/admin/category.form.js')
                                   ->load($this->getWysiwygPluginName());

        return $this->view->render('category.form', array(
            'category' => $category,
            'categories' => $this->getTree()
        ));
    }

    /**
     * Renders empty form
     * 
     * @return string
     */
    public function addAction()
    {
        return $this->createForm(new VirtualEntity(), 'Add a category');
    }

    /**
     * Renders edit form
     * 
     * @param string $id
     * @return string
     */
    public function editAction($id)
    {
        $category = $this->getModuleService('categoryManager')->fetchById($id);

        if ($category !== false) {
            return $this->createForm($category, 'Edit the category');
        } else {
            return false;
        }
    }

    /**
     * Deletes a category by its associated id
     * 
     * @return string
     */
    public function deleteAction()
    {
        // @TODO
    }

    /**
     * Persists a category
     * 
     * @return string
     */
    public function saveAction()
    {
        $input = $this->request->getPost('category');

        $formValidator = $this->validatorFactory->build(array(
            'input' => array(
                'source' => $input,
                'definition' => array(
                    'title' => new Pattern\Title()
                )
            )
        ));

        if ($formValidator->isValid()) {
            $categoryManager = $this->getModuleService('categoryManager');

            if ($input['id']) {
                $categoryManager->update($input);
                $this->flashBag->set('success', 'The category has been updated successfully');
                return '1';

            } else {
                $categoryManager->add($input);
                $this->flashBag->set('success', 'A category has been created successfully');
                return $categoryManager->getLastId();
            }

        } else {
            return $formValidator->getErrors();
        }
    }
}
