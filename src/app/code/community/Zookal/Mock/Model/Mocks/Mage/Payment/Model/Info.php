<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * needed when Mage_Payment is disabled
 * Do not change the class name, as it is needed for the autoloader because this class is somewhere in Magentos source code hardcoded :-(
 * @see Zookal_Mock_Model_Observer::_setMockIncludePath
 * Class Mage_Payment_Model_Info
 */
class Mage_Payment_Model_Info extends Zookal_Mock_Model_Mocks_Abstract
{

    /**
     * Needed in Mage_Sales_Model_Order::canEdit
     * @return $this
     */
    public function getMethodInstance()
    {
        return $this;
    }

    /**
     * Implementation of IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return new ArrayIterator(array(
            new self()
        ));
    }
}
