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

final class Add extends AbstractCategory
{
    /**
     * Shows adding form
     * 
     * @return string
     */
    public function indexAction()
    {
        $this->loadSharedPlugins();
        $title = 'Add a category';
        
        return $this->viewModel->render($this->getTemplatePath(), $this->getSharedVars(array(
            'breadcrumbs' => array(
                '#' => $title,
            ),
            
            'title' => $title
        )));
    }

    /**
     * Adds a category
     * 
     * @return string
     */
    public function addAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {
            
            $formValidator = $this->getValidator();
            
            if (1) {
                
                
            }
        }
    }
}
