<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Videogallery\Controller\Admin\Category;

final class Edit extends AbstractCategory
{
    /**
     * Shows editing form
     * 
     * @param string $id
     * @return string
     */
    public function indexAction($id)
    {
        $category = $this->getCategoryManager()->fetchById($id);

        if ($category !== false) {
            $title = 'Edit the category';

            $this->loadSharedPlugins();
            $this->loadBreadcrumbs($title);

            return $this->view->render('category.form', array(
                'title' => $title,
                'category' => $category
            ));

        } else {
            return false;
        }
    }

    /**
     * Updates a category
     * 
     * @return string
     */
    public function updateAction()
    {
        $input = $this->request->getPost('category');

        $formValidator = $this->getValidator($input);

        if ($formValidator->isValid()) {
            $categoryManager = $this->getModuleService('categoryManager');
            $categoryManager->update($input);

            $this->flashBag->set('success', 'The category has been updated successfully');
            return '1';

        } else {
            return $formValidator->getErrors();
        }
    }
}
