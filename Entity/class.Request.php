<?php


namespace ILoveMarusia\Common\Entity;

use ILoveMarusia\Common\Helper\Entity;

class Request extends Entity
{
    protected $properties = array(
        'request_id' => null,
        'json_request' => null,
        'json_response' => null,
    );
}