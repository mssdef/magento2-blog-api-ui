<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace XPS\BlogApiUi\Api\Data;

interface BlogPostsInterface
{

    const TITLE = 'title';
    const BLOG_POSTS_ID = 'blog_posts_id';
    const CONTENT = 'content';
    const CREATED_AT = 'created_at';

    /**
     * Get blog_posts_id
     * @return string|null
     */
    public function getBlogPostsId();

    /**
     * Set blog_posts_id
     * @param string $blogPostsId
     * @return \XPS\BlogApiUi\BlogPosts\Api\Data\BlogPostsInterface
     */
    public function setBlogPostsId($blogPostsId);

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \XPS\BlogApiUi\BlogPosts\Api\Data\BlogPostsInterface
     */
    public function setTitle($title);

    /**
     * Get content
     * @return string|null
     */
    public function getContent();

    /**
     * Set content
     * @param string $content
     * @return \XPS\BlogApiUi\BlogPosts\Api\Data\BlogPostsInterface
     */
    public function setContent($content);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \XPS\BlogApiUi\BlogPosts\Api\Data\BlogPostsInterface
     */
    public function setCreatedAt($createdAt);
}
