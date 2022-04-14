<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace XPS\BlogApiUi\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface BlogPostsRepositoryInterface
{

    /**
     * Save blog_posts
     * @param \XPS\BlogApiUi\Api\Data\BlogPostsInterface $blogPosts
     * @return \XPS\BlogApiUi\Api\Data\BlogPostsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \XPS\BlogApiUi\Api\Data\BlogPostsInterface $blogPosts
    );

    /**
     * Retrieve blog_posts
     * @param string $blogPostsId
     * @return \XPS\BlogApiUi\Api\Data\BlogPostsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($blogPostsId);

    /**
     * Retrieve blog_posts matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \XPS\BlogApiUi\Api\Data\BlogPostsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete blog_posts
     * @param \XPS\BlogApiUi\Api\Data\BlogPostsInterface $blogPosts
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \XPS\BlogApiUi\Api\Data\BlogPostsInterface $blogPosts
    );

    /**
     * Delete blog_posts by ID
     * @param string $blogPostsId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($blogPostsId);
}
