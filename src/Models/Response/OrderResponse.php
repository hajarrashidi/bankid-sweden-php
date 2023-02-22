<?php

namespace BankID\Models\Response;

class OrderResponse extends ResponseModel
{
    public string $orderRef;
    public string $autoStartToken;
    public string $qrStartToken;
    public string $qrStartSecret;
    
}