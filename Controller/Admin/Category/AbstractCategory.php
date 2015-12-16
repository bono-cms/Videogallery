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

use Cms\Controller\Admin\AbstractController;

abstract class AbstractCategory extends AbstractController
{
    /**
     * Loads shared plugins
     * 
     * @return void
     */
    final protected function loadSharedPlugins()
    {
    }

    /**
     * Returns configured validator instance
     * 
     * @return Validator
     */
    final protected function getValidator()
    {
    }
}
