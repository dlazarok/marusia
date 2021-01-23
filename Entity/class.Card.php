<?php


namespace ILoveMarusia\Common\Entity;

use ILoveMarusia\Common\Helper\Entity;

class Card extends Entity
{
    protected $properties = array(
        'card_id' => null,
        'type_id' => null,
        'title' => null,
        'description' => null,
        'image_id' => null,
        'items' => null,
    );
}