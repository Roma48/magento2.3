<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 2/14/19
 * Time: 5:57 PM
 */

namespace Ekreative\DrupalIntegration\Cookie;


use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\Stdlib\CookieManagerInterface;

class Customer {
  const COOKIE_NAME = 'customer_id';

  /**
   * @var \Magento\Framework\Stdlib\CookieManagerInterface
   */
  private $cookieManager;

  /**
   * @var \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory
   */
  private $cookieMetadataFactory;

  /**
   * @var \Magento\Framework\Session\SessionManagerInterface
   */
  private $sessionManager;

  /**
   * Customer constructor.
   *
   * @param \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager
   * @param \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory
   * @param \Magento\Framework\Session\SessionManagerInterface $sessionManager
   */
  public function __construct(
    CookieManagerInterface $cookieManager,
    CookieMetadataFactory $cookieMetadataFactory,
    SessionManagerInterface $sessionManager
  ) {
    $this->cookieManager = $cookieManager;
    $this->cookieMetadataFactory = $cookieMetadataFactory;
    $this->sessionManager = $sessionManager;
  }

  /**
   * @return null|string
   */
  public function get() {
    return $this->cookieManager->getCookie(self::COOKIE_NAME);
  }

  /**
   * @param $value
   * @param int $duration
   *
   * @throws \Magento\Framework\Exception\InputException
   * @throws \Magento\Framework\Stdlib\Cookie\CookieSizeLimitReachedException
   * @throws \Magento\Framework\Stdlib\Cookie\FailureToSendException
   */
  public function set($value, $duration = 86400) {
    $metadata = $this->cookieMetadataFactory
      ->createPublicCookieMetadata()
      ->setDuration($duration)
      ->setPath($this->sessionManager->getCookiePath())
      ->setDomain($this->sessionManager->getCookieDomain());

    $this->cookieManager->setPublicCookie(
      self::COOKIE_NAME,
      $value,
      $metadata
    );
  }
}