<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Videogallery\Controller\Admin;

use Cms\Controller\Admin\AbstractController;

final class Browser extends AbstractController
{
    /**
     * Shows a grid
     * 
     * @param integer $page
     * @return string
     */
    public function indexAction($page = 1)
    {
        $files = $this->getModuleService('fileManager')->fetchAllByPage($page, $this->getSharedPerPageCount(), false);
        $url = '/admin/module/videogallery/page/(:var)';

        return $this->createGrid($files, $url, null);
    }

    /**
     * Shows a grid filtered by category id
     * 
     * @param string $id Category id
     * @param integer $page Current page number
     * @return string
     */
    public function categoryAction($id, $page = 1)
    {
        $files = $this->getModuleService('fileManager')->fetchAllByPage($page, $this->getSharedPerPageCount(), false, $id);
        $url = sprintf('/admin/module/videogallery/category/%s/page/(:var)', $id);

        return $this->createGrid($files, $url, $id);
    }

    /**
     * Creates a grid
     * 
     * @param array $files
     * @param string $url
     * @param string $categoryId
     * @return string
     */
    private function createGrid(array $files, $url, $categoryId = null)
    {
        // Tweak pagination
        $paginator = $this->getModuleService('fileManager')->getPaginator();
        $paginator->setUrl($url);

        // Append a breadcrumb
        $this->view->getBreadcrumbBag()
                   ->addOne('Videogallery');

        return $this->view->render('browser', array(
            'files' => $files,
            'paginator' => $paginator,
            'categories' => $this->getModuleService('categoryManager')->fetchAllAsTree(),
            'categoryId' => $categoryId
        ));
    }
}
