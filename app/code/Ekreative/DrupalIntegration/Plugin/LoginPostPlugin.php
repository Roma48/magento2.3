<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 2/13/19
 * Time: 5:15 PM
 */

namespace Ekreative\DrupalIntegration\Plugin;


class LoginPostPlugin {
  /**
   * Change redirect after login to home instead of dashboard.
   *
   * @param \Magento\Customer\Controller\Account\LoginPost $subject
   * @param \Magento\Framework\Controller\Result\Redirect $result
   */
  public function afterExecute(
    \Magento\Customer\Controller\Account\LoginPost $subject,
    $result)
  {
    $destination = $subject->getRequest()->getParam('destination');
    if ($destination) {
      $result->setPath($destination); // Change this to what you want
    }

    return $result;
  }
}