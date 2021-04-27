<?php

namespace AHT\CRUD\Controller\Index;

use Magento\Framework\App\Cache\Frontend\Pool;
use Magento\Framework\App\Cache\TypeListInterface;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_postFactory;
    protected $_filesystem;
    protected $_save;
    protected $_session;
    protected $cacheTypeList;
    protected $cacheFrontendPool;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Filesystem $filesystem,
        \AHT\CRUD\Model\PostFactory $postFactory,
        \AHT\CRUD\Model\ResourceModel\PostFactory $save,
        \Magento\Framework\Session\SessionManagerInterface $session,
        TypeListInterface $cacheTypeList,
        Pool $cacheFrontendPool
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        $this->_filesystem = $filesystem;
        $this->_save = $save;
        $this->_session = $session;
        $this->cacheTypeList = $cacheTypeList;
        $this->cacheFrontendPool = $cacheFrontendPool;
        return parent::__construct($context);
    }

    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            $input = $this->getRequest()->getPostValue();
            $post = $this->_postFactory->create();
            $resource = $this->_save->create();

            $postId = $this->_session->getPostId();
            $this->_session->unsPostId();

            if (isset($postId)) {
                $resource->load($post, $postId);
            }

            $post->setData($input);
            $resource->save($post);

            $_types = [
                'config',
                'layout',
                'block_html',
                'collections',
                'reflection',
                'db_ddl',
                'eav',
                'config_integration',
                'config_integration_api',
                'full_page',
                'translate',
                'config_webservice',
            ];

            foreach ($_types as $type) {
                $this->cacheTypeList->cleanType($type);
            }
            foreach ($this->cacheFrontendPool as $cacheFrontend) {
                $cacheFrontend->getBackend()->clean();
            }

            return $this->_redirect('crud/index/index');
        }
    }
}
