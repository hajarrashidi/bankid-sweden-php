<?php

namespace BankID\Models\Response;

class CollectResponse extends ResponseModel
{
    public string $orderRef;
    public string $status;
    public string $hintCode;
}