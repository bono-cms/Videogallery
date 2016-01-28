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
     * Returns a tree with an empty prompt
     * 
     * @return array
     */
    final protected function getTree()
    {
        $text = sprintf('— %s —', $this->translator->translate('None'));
        return $this->getModuleService('categoryManager')->fetchAllAsTreeWithPromt($text);
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
     * Loads shared plugins
     * 
     * @return void
     */
    final protected function loadSharedPlugins()
    {
        $this->view->getPluginBag()->appendScript('@Videogallery/admin/category.form.js')
                                   ->load($this->getWysiwygPluginName());
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
