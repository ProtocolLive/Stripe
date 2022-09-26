<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/Stripe
//Version 2022.09.26.00

namespace ProtocolLive\Stripe;

class Exception extends \Exception{
  /**
   * @param Errors $code The Exception code.
   * @param string $message [optional] The Exception message to throw.
   * @param Throwable|null $previous [optional] The previous throwable used for the exception chaining.
   * @return void
   */
  public function __construct(
    protected $code,
    protected $message = null,
    protected \Throwable|null $previous = null
  ){}
}