<?php


namespace ILoveMarusia\Common\Entity;

use ILoveMarusia\Common\Helper\Entity;

class Command extends Entity
{
    protected $properties = array(
        'command_id' => null,
        'command' => null,
    );
}