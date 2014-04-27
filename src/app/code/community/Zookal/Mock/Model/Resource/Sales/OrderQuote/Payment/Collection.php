<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * Needed when Mage_Payment has been disabled.
 * This class must be implemented as a resource/rewrite
 * it extends our fake class of Mage_Payment_Model_Info because of the getIterator()
 *
 * Class Zookal_Mock_Model_Resource_Sales_Order_Payment_Collection
 */
class Zookal_Mock_Model_Resource_Sales_OrderQuote_Payment_Collection extends Mage_Payment_Model_Info
{

}