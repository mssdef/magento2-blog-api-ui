<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace XPS\BlogApiUi\Api\Data;

interface BlogPostsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get blog_posts list.
     * @return \XPS\BlogApiUi\Api\Data\BlogPostsInterface[]
     */
    public function getItems();

    /**
     * Set title list.
     * @param \XPS\BlogApiUi\Api\Data\BlogPostsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
