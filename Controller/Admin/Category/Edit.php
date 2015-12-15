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
            
            $this->loadSharedPlugins();
            $title = 'Edit the category';
            
            return $this->viewModel->render($this->getTemplatePath(), $this->getSharedVars(array(
                'breadcrumbs' => array(
                    '#' => $title
                ),
                
                'title' => $title,
                'category' => $category
            )));
            
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
        if ($this->request->isPost() && $this->request->isAjax()) {
            
            $formValidator = $this->getValidator();
            
            if (1) {
                
                
            } else {
                
                return $formValidator->getErrors();
            }
        }
    }
}
