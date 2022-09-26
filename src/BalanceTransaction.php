<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/Stripe
//Version 2022.09.26.00

namespace ProtocolLive\Stripe;

class BalanceTransaction{
  public readonly string $Id;
  public readonly int $Amount;
  public readonly int $Available;
  public readonly int $Created;
  public readonly Currencies $Currency;
  public readonly string $Description;
  public readonly int $Fee;
  public readonly int $Net;
  public readonly string $Source;
  public readonly Status $Status;
  public readonly Types $Type;

  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->Amount = $Data['amount'];
    $this->Available = $Data['available_on'];
    $this->Created = $Data['created'];
    $this->Currency = Currencies::from($Data['currency']);
    $this->Description = $Data['description'];
    $this->Fee = $Data['fee'];
    $this->Net = $Data['net'];
    $this->Source = $Data['source'];
    $this->Status = Status::from($Data['status']);
    $this->Type = Types::from($Data['type']);
  }
}