<?php

namespace AHT\CRUD\Model;
 
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
        const CACHE_TAG = 'AHT_CRUD_POST';
        
        protected function _construct()
        {
                $this->_init('AHT\CRUD\Model\ResourceModel\Post');
        }
 
        public function getIdentities()
        {
                return [self::CACHE_TAG . '_' . $this->getId()];
        }
 
        public function getDefaultValues()
        {
                $values = [];
 
                return $values;
        }
}