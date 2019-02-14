<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 2/14/19
 * Time: 12:58 PM
 */

namespace Ekreative\DrupalIntegration\Block\Form;


class Login extends \Magento\Customer\Block\Form\Login {
  /**
   * Retrieve form posting url
   *
   * @return string
   */
  public function getPostActionUrl()
  {
    if (isset($_GET['destination'])) {
      return $this->_customerUrl->getLoginPostUrl() . '?destination=' . $_GET['destination'];
    }

    return $this->_customerUrl->getLoginPostUrl();
  }
}