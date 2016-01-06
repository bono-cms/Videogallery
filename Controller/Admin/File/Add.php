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

use Krystal\Stdlib\VirtualEntity;

final class Add extends AbstractFile
{
    /**
     * Shows adding form
     * 
     * @return string
     */
    public function indexAction()
    {
        $title = 'Add a video';

        $this->loadSharedPlugins();
        $this->loadBreadcrumbs($title);

        $video = new VirtualEntity();
        $video->setPublished(true);

        return $this->view->render('file.form', array(
            'title' => $title,
            'video' => $video
        ));
    }

    /**
     * Uploads a video file
     * 
     * @return string
     */
    public function addAction()
    {
        $input = $this->request->getPost('file');
        $formValidator = $this->getValidator($input);

        if ($formValidator->isValid()) {

            $fileManager = $this->getFileManager();
            $fileManager->add($input);

            $this->flashMessenger->set('success', 'A video has been added successfully');
            return $fileManager->getLastId();

        } else {
            return $formValidator->getErrors();
        }
    }
}
