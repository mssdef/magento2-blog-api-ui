<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace XPS\BlogApiUi\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use XPS\BlogApiUi\Api\BlogPostsRepositoryInterface;
use XPS\BlogApiUi\Api\Data\BlogPostsInterface;
use XPS\BlogApiUi\Api\Data\BlogPostsInterfaceFactory;
use XPS\BlogApiUi\Api\Data\BlogPostsSearchResultsInterfaceFactory;
use XPS\BlogApiUi\Model\ResourceModel\BlogPosts as ResourceBlogPosts;
use XPS\BlogApiUi\Model\ResourceModel\BlogPosts\CollectionFactory as BlogPostsCollectionFactory;

class BlogPostsRepository implements BlogPostsRepositoryInterface
{
    /**
     * @var BlogPosts
     */
    protected $searchResultsFactory;

    /**
     * @var ResourceBlogPosts
     */
    protected $resource;

    /**
     * @var BlogPostsInterfaceFactory
     */
    protected $blogPostsFactory;

    /**
     * @var BlogPostsCollectionFactory
     */
    protected $blogPostsCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @param ResourceBlogPosts $resource
     * @param BlogPostsInterfaceFactory $blogPostsFactory
     * @param BlogPostsCollectionFactory $blogPostsCollectionFactory
     * @param BlogPostsSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceBlogPosts $resource,
        BlogPostsInterfaceFactory $blogPostsFactory,
        BlogPostsCollectionFactory $blogPostsCollectionFactory,
        BlogPostsSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->blogPostsFactory = $blogPostsFactory;
        $this->blogPostsCollectionFactory = $blogPostsCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(BlogPostsInterface $blogPosts)
    {
        try {
            $this->resource->save($blogPosts);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the blogPosts: %1',
                $exception->getMessage()
            ));
        }
        return $blogPosts;
    }

    /**
     * @inheritDoc
     */
    public function get($blogPostsId)
    {
        $blogPosts = $this->blogPostsFactory->create();
        $this->resource->load($blogPosts, $blogPostsId);
        if (!$blogPosts->getId()) {
            throw new NoSuchEntityException(__('blog_posts with id "%1" does not exist.', $blogPostsId));
        }
        return $blogPosts;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->blogPostsCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(BlogPostsInterface $blogPosts)
    {
        try {
            $blogPostsModel = $this->blogPostsFactory->create();
            $this->resource->load($blogPostsModel, $blogPosts->getBlogPostsId());
            $this->resource->delete($blogPostsModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the blog_posts: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($blogPostsId)
    {
        return $this->delete($this->get($blogPostsId));
    }
}
