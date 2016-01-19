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

use Cms\Controller\Admin\AbstractController;
use Krystal\Validate\Pattern;

abstract class AbstractFile extends AbstractController
{
    /**
     * Returns prepared validator
     * 
     * @param array $input Raw input data to be validated
     * @return \Krystal\Validate\ValidatorChain
     */
    final protected function getValidator(array $input)
    {
        return $this->validatorFactory->build(array(
            'input' => array(
                'source' => $input,
                'definition' => array(
                    'title' => new Pattern\Name(),
                    'description' => new Pattern\Description()
                )
            )
        ));
    }

    /**
     * Load breadcrumbs
     * 
     * @param string $title Title of the latest one
     * @return void
     */
    final protected function loadBreadcrumbs($title)
    {
        $this->view->getBreadcrumbBag()
                   ->addOne('Videogallery', 'Videogallery:Admin:Browser@indexAction')
                   ->addOne($title);
    }

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
