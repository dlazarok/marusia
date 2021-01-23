<?php


namespace ILoveMarusia\Common\Entity;

use ILoveMarusia\Common\Helper\Entity;

class Session extends Entity
{
    protected $properties = array(
        'session_id' => null,
        'user_id' => null,
        'message_id' => null,
        'response_id' => null,
    );
}