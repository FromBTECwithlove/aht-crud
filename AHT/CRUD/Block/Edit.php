<?php

namespace AHT\CRUD\Block;

class Edit extends \Magento\Framework\View\Element\Template
{
    protected $_pageFactory;
    protected $_coreRegistry;
    protected $_postLoader;
    protected $_postResource;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Registry $coreRegistry,
        \AHT\CRUD\Model\PostFactory $postLoader,
        \AHT\CRUD\Model\ResourceModel\PostFactory $postResource,

        array $data = []
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_postResource = $postResource;
        $this->_coreRegistry = $coreRegistry;
        $this->_postLoader = $postLoader;
        return parent::__construct($context, $data);
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }

    public function getEditRecord()
    {
        // $id = $this->_coreRegistry->registry('editRecordId');
        // $post = $this->_postLoader->create();
        // $result = $post->load($id);
        // $result = $result->getData();
        // return $result;

        $id = $this->_coreRegistry->registry('editRecordId');
        
            $post = $this->_postLoader->create();
            
            $postResource = $this->_postResource->create();
            
            $postResource->load($post, $id);
        
            return $post;
    }
}
