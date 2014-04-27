<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Model_ObserverController
{

    /**
     * @fire controller_action_postdispatch_checkout_onepage_saveShippingMethod
     *
     * @param Varien_Event_Observer $observer
     *
     * @return null
     */
    public function afterSaveShippingMethod(Varien_Event_Observer $observer)
    {
        if (false === Mage::getSingleton('zookal_mock/observer')->isPaymentModuleDisabled()) {
            return null;
        }
        /** @var Mage_Checkout_Controller_Action $action */
        $action = $observer->getEvent()->getControllerAction();

        if (!($action instanceof Mage_Checkout_Controller_Action)) {
            return null;
        }

        $responseArray = Mage::helper('core')->jsonDecode($action->getResponse()->getBody());

        if (isset($responseArray['goto_section']) && 'payment' === $responseArray['goto_section']) {
            $responseArray['goto_section']   = 'review';
            $responseArray['update_section'] = array(
                'name' => 'review',
                'html' => $this->_getReviewHtml($action)
            );
        }
        $action->getResponse()->setBody(Mage::helper('core')->jsonEncode($responseArray));

        return null;
    }

    /**
     * Get order review step html
     *
     * @param Mage_Checkout_Controller_Action $action
     *
     * @return string
     */
    protected function _getReviewHtml(Mage_Checkout_Controller_Action $action)
    {
        $action->getLayout()->getUpdate()->resetHandles();
        $action->getLayout()->getUpdate()->load('checkout_onepage_review');
        $action->getLayout()->generateXml();
        $action->getLayout()->generateBlocks();

//        Zend_Debug::dump($action->getLayout()->getBlock('root'));
//        exit;

        return $action->getLayout()->getBlock('root')->toHtml();
    }
}