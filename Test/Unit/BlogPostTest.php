<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace XPS\BlogApiUi\Test\Unit;

use XPS\BlogApiUi\Controller\Posts\Submit;
use \XPS\BlogApiUi\Model\BlogPosts;
use Magento\Framework\App\Response\Http;
use Magento\Framework\App\RequestInterface as Request;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BlogPostTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var Submit
     */
    private $sut;

    /**
     * Is called before running a test
     */
    protected function setUp(): void
    {
		$this->objectManager = new ObjectManager($this);

        $model = $this->createMock(BlogPosts::class);
        $model->expects($this->atLeastOnce())->method('save');

        $request = $this->getMockBuilder(Request::class)
            ->setMethods(['isPost','getModuleName','setModuleName','setActionName','getPost',
                'setParams','getParam','getActionName','getCookie','getParams','isSecure'])
                ->getMock();
        $request->method('isPost')->willReturn(true);
        $request->method('getPost')->willReturn([]);

        $http = $this->createMock(Http::class);
        $http->method('getHeaders')->willReturn($http);

        $this->sut = $this->objectManager->getObject(
            Submit::class,
            [
                'model' => $model,
                'http' => $http,
                'request' => $request
            ]
        );

        $requestBlank = $this->getMockBuilder(Request::class)
            ->setMethods(['isPost','getModuleName','setModuleName','setActionName','getPost',
                'setParams','getParam','getActionName','getCookie','getParams','isSecure'])
                ->getMock();
        $requestBlank->method('isPost')->willReturn(false);
        $modelNever = $this->createMock(BlogPosts::class);
        $modelNever->expects($this->never())->method('save');
        $this->sutWrong = $this->objectManager->getObject(
            Submit::class,
            [
                'model' => $modelNever,
                'http' => $http,
                'request' => $requestBlank
            ]
        );
    }

    /**
     * The test itself, every test function must start with 'test'
     */
    public function testExecute()
    {
        $resp = $this->sut->execute();
        $resp = $this->sutWrong->execute();

        $this->assertTrue(true);
    }
}
