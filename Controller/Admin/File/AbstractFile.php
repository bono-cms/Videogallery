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

abstract class AbstractFile extends AbstractController
{
    /**
     * Load shared view plugins
     * 
     * @return void
     */
    final protected function loadSharedPlugins()
    {
        $this->view->getPluginBag()
                   ->load($this->getWysiwygPluginName());
    }
}
