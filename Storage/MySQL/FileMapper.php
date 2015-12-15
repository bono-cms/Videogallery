<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Videogallery\Storage\MySQL;

use Cms\Storage\MySQL\AbstractMapper;
use Videogallery\Storage\FileMapperInterface;

final class FileMapper extends AbstractMapper implements FileMapperInterface
{
    /**
     * {@inheritDoc}
     */
    public static function getTableName()
    {
        return 'bono_module_videogallery_files';
    }

    /**
     * Fetches a record by its associated id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id)
    {
        return $this->findByPk($id);
    }

    /**
     * Fetch all records filtered by pagination
     * 
     * @param integer $page
     * @param integer $itemsPerPage
     * @param boolean $published Whether to fetch only published records
     * @return array
     */
    public function fetchAllByPage($page, $itemsPerPage, $published)
    {
        $db = $this->db->select('*')
                       ->from(self::getTableName())
                       ->whereEquals('langId', $this->getLangId());

        if ($published === true) {
            $db->andWhereEquals('published', '1');
        }

        return $db->orderBy('id')
                  ->desc()
                  ->paginate($page, $itemsPerPage)
                  ->queryAll();
    }
}
