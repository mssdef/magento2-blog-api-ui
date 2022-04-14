<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace XPS\BlogApiUi\Controller\Adminhtml\Blogposts;

class Delete extends \XPS\BlogApiUi\Controller\Adminhtml\Blogposts
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('blog_posts_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\XPS\BlogApiUi\Model\BlogPosts::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Blog Posts.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['blog_posts_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Blog Posts to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
