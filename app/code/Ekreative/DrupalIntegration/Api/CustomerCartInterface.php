<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 2/14/19
 * Time: 2:11 PM
 */

namespace Ekreative\DrupalIntegration\Api;


interface CustomerCartInterface {
  /**
   * Returns greeting message to user
   *
   * @api
   * @param string $sessionId Users name.
   * @return string.
   */
  public function getCartInfo($sessionId);
}