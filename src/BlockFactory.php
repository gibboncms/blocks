<?php

namespace GibbonCms\Blocks;

use GibbonCms\Gibbon\Factories\Factory;
use GibbonCms\Gibbon\Support\FactoryHelpers;

class BlockFactory implements Factory
{
    use FactoryHelpers;

    /**
     * Transform raw data to an entity
     * 
     * @param array $data
     * @return \GibbonCms\Blocks\Block
     */
    public function make($data)
    {
        $parts = $this->splitData($data['data'], ['meta', 'body']);

        $meta = self::parseYaml($parts['meta']);

        return $this->createAndFill([
            'id'                => $data['id'],
            'attributes'        => $meta,
            'body'              => $parts['body'],
        ]);
    }

    /**
     * Transform a block to raw data
     * 
     * @param \GibbonCms\Blocks\Block $block
     * @return string
     */
    public function encode($block)
    {
        $contents = ''
            . $this->dumpToSimpleYaml($block->attributes)
            . $this->getDataSeparator()
            . $block->body
        ;

        return $contents;
    }

    /**
     * Return the classname of the entity this factory makes
     * 
     * @return string
     */
    public static function makes()
    {
        return Block::class;
    }
}
