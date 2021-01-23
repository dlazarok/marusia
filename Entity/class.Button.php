<?php

namespace ILoveMarusia\Common\Entity;

use ILoveMarusia\Common\Helper\Entity;

class Button extends Entity
{
    protected $properties = array(
        'button_id' => null,
        'response_id' => null,
        'title' => null,
        'url' => null,
        'next' => null,
    );
}