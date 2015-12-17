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

use Krystal\Stdlib\VirtualEntity;

final class Add extends AbstractCategory
{
    /**
     * Shows adding form
     * 
     * @return string
     */
    public function indexAction()
    {
        $title = 'Add a category';

        $this->loadSharedPlugins();
        $this->loadBreadcrumbs($title);

        return $this->view->render('category.form', array(
            'title' => $title
            'category' => new VirtualEntity()
        ));
    }

    /**
     * Adds a category
     * 
     * @return string
     */
    public function addAction()
    {
        $input = $this->request->getPost('category');
        $formValidator = $this->getValidator($input);

        if ($formValidator->isValid()) {
            $categoryManager = $this->getModuleService('categoryManager');
            $categoryManager->add($input);

            $this->flashBag->set('success', 'A category has been created successfully');
            return $categoryManager->getLastId();

        } else {
            return $formValidator->getErrors();
        }
    }
}
