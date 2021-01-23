<?php


namespace ILoveMarusia\Common\Entity;

use ILoveMarusia\Common\Helper\Entity;

class Response extends Entity
{
    protected $properties = array(
        'response_id' => null,
        'version_id' => null,
        'text' => null,
        'end_session' => null,
        'card_id' => null,
    );
}