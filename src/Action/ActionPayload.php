<?php

namespace App\Action;

use JsonSerializable;

class ActionPayload implements JsonSerializable
{

    private $statusCode;
    private $data;
    private $responseWrapper;
    private $error;

    public function __construct(
        int $statusCode = 200,
        $data = null,
        ?ActionError $error = null
    ) {
        $this->statusCode = $statusCode;
        $this->data = $data;
        $this->error = $error;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getError()
    {
        return $this->error;
    }

    public function jsonSerialize()
    {
        $payload = [];

        if (is_array($this->data)) {
            $payload = $this->data;
        } else if ($this->data !== null) {
            $payload[] = $this->data;
        } else if ($this->error !== null) {
            $payload[] = $this->error;
        }

        return $payload;
    }
}
