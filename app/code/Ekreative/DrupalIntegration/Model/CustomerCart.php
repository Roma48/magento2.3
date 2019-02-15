<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 2/14/19
 * Time: 2:14 PM
 */

namespace Ekreative\DrupalIntegration\Model;

use Ekreative\DrupalIntegration\Api\CustomerCartInterface;
use Magento\Framework\ObjectManagerInterface;

/**
 * Class CustomerCart
 *
 * @package Ekreative\DrupalIntegration\Model
 */
class CustomerCart implements CustomerCartInterface {

  /**
   * @var ObjectManagerInterface
   */
  private $objectManager;

  /**
   * CustomerCart constructor.
   *
   * @param \Magento\Checkout\Model\Session $session
   */
  public function __construct(ObjectManagerInterface $objectManager) {
    $this->objectManager = $objectManager;
  }

  /**
   * Returns greeting message to user
   *
   * @api
   * @param string $sessionId Customer sessionID.
   * @return array|string.
   */
  public function getCartInfo($sessionId) {
    /** @var \Magento\Customer\Model\Customer $customer */
    $customer = $this->objectManager->get('\Magento\Customer\Model\Customer');
    $customer->load($sessionId);
    /** @var \Magento\Checkout\Model\Session $checkoutSession */
    $checkoutSession = $this->objectManager->get('\Magento\Checkout\Model\Session');
    /** @var \Magento\Quote\Model\Quote $quote */
    $quote = $checkoutSession->getQuote()->loadByCustomer($customer);
    $items = $quote->getAllVisibleItems();

    $response = [];
    /** @var \Magento\Quote\Model\Quote\Item $item */
    foreach ($items as $item) {
      $response['response']['cart_items'][] = [
        'product_id' => $item->getProduct()->getId(),
        'title' => $item->getProduct()->getName(),
        'qty' => $item->getQty()
      ];
    }

    if (!empty($response)) {
      return $response;
    }

    return 'Session doesn\'t exists.';
  }
}