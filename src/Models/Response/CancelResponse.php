<?php

namespace BankID\Models\Response;

class CancelResponse extends ResponseModel
{
    public string $orderRef;
    public string $status;
    public string $hintCode;
}