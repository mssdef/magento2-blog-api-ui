<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace XPS\BlogApiUi\Model;

use Magento\Framework\Model\AbstractModel;
use XPS\BlogApiUi\Api\Data\BlogPostsInterface;

class BlogPosts extends AbstractModel implements BlogPostsInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\XPS\BlogApiUi\Model\ResourceModel\BlogPosts::class);
    }

    /**
     * @inheritDoc
     */
    public function getBlogPostsId()
    {
        return $this->getData(self::BLOG_POSTS_ID);
    }

    /**
     * @inheritDoc
     */
    public function setBlogPostsId($blogPostsId)
    {
        return $this->setData(self::BLOG_POSTS_ID, $blogPostsId);
    }

    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @inheritDoc
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}

