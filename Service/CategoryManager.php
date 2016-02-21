<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Videogallery\Service;

use Cms\Service\WebPageManagerInterface;
use Cms\Service\AbstractManager;
use Cms\Service\HistoryManagerInterface;
use Videogallery\Storage\CategoryMapperInterface;
use Krystal\Stdlib\VirtualEntity;
use Krystal\Stdlib\ArrayUtils;
use Krystal\Tree\AdjacencyList\TreeBuilder;
use Krystal\Tree\AdjacencyList\Render\PhpArray;

final class CategoryManager extends AbstractManager implements CategoryManagerInterface
{
    /**
     * Any compliant category mapper
     * 
     * @var \Videogallery\Storage\CategoryMapperInterface
     */
    private $categoryMapper;

    /**
     * Web page manager to deal with slugs
     * 
     * @var \Cms\Service\WebPageManagerInterface
     */
    private $webPageManager;

    /**
     * History manager to keep tracks
     * 
     * @var \Cms\Service\HistoryManagerInterface
     */
    private $historyManager;

    /**
     * State initialization
     * 
     * @param \Videogallery\Storage\CategoryMapperInterface $categoryMapper
     * @param \Cms\Service\WebPageManagerInterface $webPageManager
     * @param \Cms\Service\HistoryManagerInterface $historyManager
     * @return void
     */
    public function __construct(CategoryMapperInterface $categoryMapper, WebPageManagerInterface $webPageManager, HistoryManagerInterface $historyManager)
    {
        $this->categoryMapper = $categoryMapper;
        $this->webPageManager = $webPageManager;
        $this->historyManager = $historyManager;
    }

    /**
     * {@inheritDoc}
     */
    protected function toEntity(array $category)
    {
        $entity = new VirtualEntity();
        $entity->setId((int) $category['id'])
               ->setParentId((int) $category['parent_id'])
               ->setTitle($category['title'])
               ->setDescription($category['description'])
               ->setSeo((bool) $category['seo'])
               ->setKeywords($category['keywords'])
               ->setMetaDescription($category['meta_description']);

        return $entity;
    }

    /**
     * Tracks activity
     * 
     * @param string $message
     * @param string $placeholder
     * @return boolean
     */
    private function track($message, $placeholder)
    {
        return $this->historyManager->write('Videogallery', $message, $placeholder);
    }

    /**
     * Returns a tree pre-pending prompting message
     * 
     * @param string $text
     * @return array
     */
    public function fetchAllAsTreeWithPromt($text)
    {
        $tree = $this->fetchAllAsTree();
        ArrayUtils::assocPrepend($tree, null, $text);

        return $tree;
    }

    /**
     * Fetches all categories as a tree
     * 
     * @return array
     */
    public function fetchAllAsTree()
    {
        $treeBuilder = new TreeBuilder($this->categoryMapper->fetchAll());
        return $treeBuilder->render(new PhpArray('title'));
    }

    /**
     * Returns last category id
     * 
     * @return integer
     */
    public function getLastId()
    {
        return $this->categoryMapper->getLastId();
    }

    /**
     * Fetches all category entities
     * 
     * @return array
     */
    public function fetchAll()
    {
        return $this->prepareResults($this->categoryMapper->fetchAll());
    }

    /**
     * Fetches category's entity by its associated id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id)
    {
        return $this->prepareResult($this->categoryMapper->fetchById($id));
    }

    /**
     * Deletes a category
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id)
    {
        return $this->categoryMapper->deleteById($id);
    }

    /**
     * Adds a category
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function add(array $input)
    {
        return $this->categoryMapper->insert(ArrayUtils::arrayWithout($input, array('slug')));
    }

    /**
     * Updates a category
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function update(array $input)
    {
        return $this->categoryMapper->update(ArrayUtils::arrayWithout($input, array('slug')));
    }
}
