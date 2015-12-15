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

use Admin\Controller\Admin\AbstractController;
use stdclass;

abstract class AbstractFile extends AbstractController
{
    /**
     * Returns request container
     * 
     * @return \stdclass
     */
    final protected function getContainer()
    {
        $container = new stdclass();
        
        // Data
        $container->name = $this->request->getPost('name');
        $container->title = $this->request->getPost('title');
        
        // Files
        $container->coverFile = $this->request->getFiles('coverFile');
        $container->videoFile = $this->request->getFiles('videoFile');
        
        return $container;
    }

    /**
     * Returns template path
     * 
     * @return string
     */
    final protected function getTemplatePath()
    {
        return 'file.form';
    }

    /**
     * Returns file manager
     * 
     * @return \Videogallery\Service\FileManager
     */
    final protected function getFIleManager()
    {
        return $this->moduleManager->getModule('Videogallery')->getService('fileManager');
    }

    /**
     * Loads shared plugins
     * 
     * @return void
     */
    final protected function loadSharedPlugins()
    {
        $this->viewModel->loadPlugin('ckeditor');
    }

    /**
     * Return shared variables
     * 
     * @param array $overrides
     * @return array
     */
    final protected function getSharedVars(array $overrides)
    {
        $vars = array(
            'breadcrumbs' => array(
                'Videogallery:Admin:Browser@indexAction' => 'Videogallery'
            )
        );
        
        return array_replace_recursive($vars, $overrides);
    }
    
    
}
