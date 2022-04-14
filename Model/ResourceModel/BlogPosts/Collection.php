<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 * @SuppressWarnings(PHPMD)
 */
declare(strict_types=1);

namespace XPS\BlogApiUi\Model\ResourceModel\BlogPosts;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * @SuppressWarnings(PHPMD)
 */
class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'blog_posts_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \XPS\BlogApiUi\Model\BlogPosts::class,
            \XPS\BlogApiUi\Model\ResourceModel\BlogPosts::class
        );
    }
}
