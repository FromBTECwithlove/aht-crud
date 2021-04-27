<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        https://www.codilar.com/
 */

namespace AHT\HelloWorld\Block;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    public function getText() {
        echo "You are mine!";
    }
}