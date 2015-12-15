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

use Admin\Service\AbstractManager;
use Admin\Storage\CategoryMapperInterface;
use stdclass;

final class CategoryManager extends AbstractManager
{
	/**
	 * Category mapper
	 * 
	 * @var CategoryMapperInterface
	 */
	private $categoryMapper;

	/**
	 * State initialization
	 * 
	 * @param CategoryMapperInterface $categoryMapper
	 * @return void
	 */
	public function __construct(CategoryMapperInterface $categoryMapper)
	{
		$this->categoryMapper = $categoryMapper;
	}

	/**
	 * Returns prepared paginator instance
	 * 
	 * @return object
	 */
	public function getPaginator()
	{
		return $this->categoryMapper->getPaginator();
	}

	/**
	 * Fetch all records by page
	 * 
	 * @param integer $page
	 * @param integer $itemsPerPage
	 * @return array
	 */
	public function fetchAllByPage($page, $itemsPerPage)
	{
		return $this->prepareResults($this->categoryMapper->fetchAllByPage($page, $itemsPerPage));
	}

	/**
	 * Fetch all published by page
	 * 
	 * @param integer $page
	 * @param integer $itemsPerPage
	 * @return array
	 */
	public function fetchAllPublishedByPage($page, $itemsPerPage)
	{
		return $this->prepareResults($this->categoryMapper->fetchAllPublishedByPage($page, $itemsPerPage));
	}

	/**
	 * Fetches category info by its associated id
	 * 
	 * @param string $id
	 * @return array
	 */
	public function fetchById($id)
	{
		return $this->prepareResult($this->categoryMapper->fetchById($id));
	}

	/**
	 * Deletes a record 
	 * 
	 * @param string $id
	 * @return boolean
	 */
	public function deleteById($id)
	{
		return $this->categoryMapper->deleteById($id);
	}

	/**
	 * Inserts a record
	 * 
	 * @param stdclass $container
	 * @return boolean
	 */
	public function add(stdclass $container)
	{
		return $this->categoryMapper->insert($container);
	}

	/**
	 * Updates a record
	 * 
	 * @param stdclass $container
	 * @return boolean
	 */
	public function update(stdclass $container)
	{
		return $this->categoryMapper->update($container);
	}
}
