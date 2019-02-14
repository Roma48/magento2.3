<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 2/13/19
 * Time: 5:15 PM
 */

namespace Ekreative\DrupalIntegration\Plugin;

use Magento\Framework\ObjectManagerInterface;

/**
 * Class LoginPostPlugin
 *
 * @package Ekreative\DrupalIntegration\Plugin
 */
class LoginPostPlugin {
  /**
   * @var \Magento\Framework\ObjectManagerInterface
   */
  private $objectManager;

  /**
   * LoginPostPlugin constructor.
   *
   * @param \Magento\Framework\ObjectManagerInterface $objectManager
   */
  public function __construct(ObjectManagerInterface $objectManager) {
    $this->objectManager = $objectManager;
  }

  /**
   * @param \Magento\Customer\Controller\Account\LoginPost $subject
   * @param $result
   *
   * @return mixed
   */
  public function afterExecute(
    \Magento\Customer\Controller\Account\LoginPost $subject,
    $result)
  {
    $destination = $subject->getRequest()->getParam('destination');
    if ($destination) {
      $result->setPath($destination);
    }

    /** @var \Magento\Customer\Model\Session $customerSession */
    $customerSession = $this->objectManager->get('\Magento\Customer\Model\Session');
    /** @var \Magento\Customer\Model\Customer $customer */
    $customer = $customerSession->getCustomer();

    $this->objectManager->get('\Ekreative\DrupalIntegration\Cookie\Customer')
      ->set($customer->getId());

    return $result;
  }
}