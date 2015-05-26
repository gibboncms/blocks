<?php

namespace GibbonCms\Blocks;

use GibbonCms\Gibbon\Entities\Entity;

class Block extends Entity
{
    /**
     * @var string
     */
    public $body;
    
    /**
     * @var array
     */
    public $attributes;

    /**
     * @param  string $element  The element that should be used to wrap the block
     * @return string
     */
    public function render($element = null)
    {
        $element = $element ?: 'div';

        $attributes = [];
        foreach ($this->attributes as $attribute => $value) {
            $attributes[] = "$attribute=\"$value\"";
        }

        $rendered = "<$element ".implode(' ', $attributes).">".
                    BlockFactory::parseMarkdown($this->body).
                    "</$element>"
        ;

        return $rendered;        
    }
}
