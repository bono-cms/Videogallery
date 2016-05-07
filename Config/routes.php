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
    '/%s/module/videogallery' => array(
        'controller' => 'Admin:Browser@indexAction'
    ),

    '/%s/module/videogallery/tweak' => array(
        'controller' => 'Admin:File@tweakAction',
        'disallow' => array('guest')
    ),

    '/%s/module/videogallery/video/delete' => array(
        'controller' => 'Admin:File@deleteAction',
        'disallow' => array('guest')
    ),
    
    '/%s/module/videogallery/page/(:var)' => array(
        'controller' => 'Admin:Browser@indexAction'
    ),
    
    '/%s/module/videogallery/category/view/(:var)' => array(
        'controller' => 'Admin:Browser@categoryAction'
    ),

    '/%s/module/videogallery/category/(:var)/page/(:var)' => array(
        'controller' => 'Admin:Browser@categoryAction'
    ),
    
    '/%s/module/videogallery/category/add' => array(
        'controller' => 'Admin:Category@addAction'
    ),

    '/%s/module/videogallery/category/edit/(:var)' => array(
        'controller' => 'Admin:Category@editAction'
    ),

    '/%s/module/videogallery/category/save' => array(
        'controller' => 'Admin:Category@saveAction'
    ),
    
    '/%s/module/videogallery/file/add' => array(
        'controller' => 'Admin:File@addAction'
    ),
    
    '/%s/module/videogallery/file/edit/(:var)' => array(
        'controller' => 'Admin:File@editAction'
    ),
    
    '/%s/module/videogallery/file/save' => array(
        'controller' => 'Admin:File@saveAction'
    )
);
