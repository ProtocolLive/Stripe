<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/Stripe

namespace ProtocolLive\Stripe;

/**
 * @version 2024.01.02.00
 */
final class Stripe{
  const Url = 'https://api.stripe.com/v1/';

  public function __construct(
    private readonly string $Token,
    private readonly string $DirLogs,
  ){}

  public function BalanceTransaction(
    string $Id = null,
    string $Source = null
  ):BalanceTransaction|null{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . '/cacert.pem');
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, $this->Token . ':');

    $url = self::Url . 'balance_transactions';
    $get = [];
    if($Id !== null):
      $url .= '/' . $Id;
    endif;
    if($Source !== null):
      $get['source'] = $Source;
    endif;
    if($get !== []):
      $url .= '?' . http_build_query($get);
    endif;
    curl_setopt($curl, CURLOPT_URL, $url);

    $return = curl_exec($curl);
    if($return === false):
      return null;
    endif;
    file_put_contents($this->DirLogs . '/stripe.log', $return);
    $return = json_decode($return, true);
    if(isset($return['error'])):
      throw new Exception(Errors::NotFound, $return['message']);
    endif;
    return new BalanceTransaction($return['data'][0]);
  }
}