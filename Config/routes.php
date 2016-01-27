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
        'controller' => 'Admin:Category:Add@indexAction'
    ),

    '/admin/module/videogallery/category/add.ajax' => array(
        'controller' => 'Admin:Category:Add@addAction'
    ),

    '/admin/module/videogallery/category/edit/(:var)' => array(
        'controller' => 'Admin:Category:Edit@indexAction'
    ),

    '/admin/module/videogallery/category/edit.ajax' => array(
        'controller' => 'Admin:Category:Edit@updateAction'
    ),
    
    '/admin/module/videogallery/file/add' => array(
        'controller' => 'Admin:File:Add@indexAction'
    ),
    
    '/admin/module/videogallery/file/add.ajax' => array(
        'controller'=> 'Admin:File:Add@addAction'
    ),
    
    '/admin/module/videogallery/file/edit/(:var)' => array(
        'controller' => 'Admin:File:Edit@indexAction'
    ),
    
    '/admin/module/videogallery/file/edit.ajax' => array(
        'controller' => 'Admin:File:Edit@updateAction'
    )
);
