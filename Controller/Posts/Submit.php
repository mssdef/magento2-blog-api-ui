<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace XPS\BlogApiUi\Controller\Posts;

use \XPS\BlogApiUi\Model\BlogPosts;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface as Request;
use Magento\Framework\App\Response\Http;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;

class Submit implements HttpPostActionInterface
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var Json
     */
    protected $serializer;
    /**
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * @var Http
     */
    protected $http;

    /**
     * @var Request
     **/
    protected $request;

    /**
     * @var BlogPosts
     **/
    protected $model;

    /**
     * Constructor
     *
     * @param PageFactory $resultPageFactory
     * @param Json $json
     * @param LoggerInterface $logger
     * @param Http $http
     */
    public function __construct(
        PageFactory $resultPageFactory,
        Json $json,
        LoggerInterface $logger,
        Request $request,
        BlogPosts $model,
        Http $http
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->serializer = $json;
        $this->logger = $logger;
        $this->http = $http;
        $this->request = $request;
        $this->model = $model;
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        try {
            if ($this->request->isPost()) {
                $data = $this->request->getPost();
                $this->model->setData((array)$data);
                $this->model->save();

                return $this->jsonResponse((object)['status' => 'ok']);
            } else {
                return $this->jsonResponse((object)['status' => 'error']);
            }
        } catch (LocalizedException $e) {
            return $this->jsonResponse((object)['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            $this->logger->critical($e);
            return $this->jsonResponse((object)['error' => $e->getMessage()]);
        }
    }

    /**
     * Create json response
     *
     * @return ResultInterface
     */
    public function jsonResponse($response = '')
    {
        $this->http->getHeaders()->clearHeaders();
        $this->http->setHeader('Content-Type', 'application/json');
        $this->http->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate');
        return $this->http->setBody(
            $this->serializer->serialize($response)
        );
    }
}
