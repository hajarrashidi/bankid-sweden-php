<?php

namespace BankID\Models\Response;

class ErrorResponse extends ResponseModel
{
    public string $errorCode;
    public string $details;
}