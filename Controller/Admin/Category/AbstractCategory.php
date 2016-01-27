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
use Krystal\Validate\Pattern;

abstract class AbstractCategory extends AbstractController
{
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
     * @param array $input Raw input data
     * @return \Krystal\Validate\ValidatorChain
     */
    final protected function getValidator(array $input)
    {
        return $this->validatorFactory->build(array(
            'input' => array(
                'source' => $input,
                'definition' => array(
                    'title' => new Pattern\Title()
                )
            )
        ));
    }
}
