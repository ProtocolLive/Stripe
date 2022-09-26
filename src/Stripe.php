<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/Stripe
//Version 2022.09.26.00

namespace ProtocolLive\Stripe;

final class Stripe{
  const Url = 'https://api.stripe.com/v1/';

  public function __construct(
    private readonly string $Token
  ){}

  public function TransactionBalance(
    string $Id
  ):TransactionBalance|null{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Protocol TelegramBotLibrary');
    curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . '/cacert.pem');
    curl_setopt($curl, CURLOPT_URL, self::Url . 'balance_transactions/' . $Id);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, $this->Token . ':');
    $return = curl_exec($curl);
    if($return === false):
      return null;
    endif;
    $return = json_decode($return, true);
    return new TransactionBalance($return);
  }
}