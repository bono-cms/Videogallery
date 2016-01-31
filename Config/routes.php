<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

return array(
    '/admin/module/videogallery' => array(
        'controller' => 'Admin:Browser@indexAction'
    ),

    '/admin/module/videogallery/page/(:var)' => array(
        'controller' => 'Admin:Browser@indexAction'
    ),
    
    '/admin/module/videogallery/category/view/(:var)' => array(
        'controller' => 'Admin:Browser@categoryAction'
    ),

    '/admin/module/videogallery/category/(:var)/page/(:var)' => array(
        'controller' => 'Admin:Browser@categoryAction'
    ),
    
    '/admin/module/videogallery/category/add' => array(
        'controller' => 'Admin:Category@addAction'
    ),

    '/admin/module/videogallery/category/edit/(:var)' => array(
        'controller' => 'Admin:Category@editAction'
    ),

    '/admin/module/videogallery/category/save' => array(
        'controller' => 'Admin:Category@saveAction'
    ),
    
    '/admin/module/videogallery/file/add' => array(
        'controller' => 'Admin:File@addAction'
    ),
    
    '/admin/module/videogallery/file/edit/(:var)' => array(
        'controller' => 'Admin:File@editAction'
    ),
    
    '/admin/module/videogallery/file/save' => array(
        'controller' => 'Admin:File@saveAction'
    )
);
