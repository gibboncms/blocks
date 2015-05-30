<?php

namespace GibbonCms\Blocks\Test;

use GibbonCms\Blocks\Block;
use GibbonCms\Blocks\BlockFactory;

class BlockFactoryTest extends TestCase
{
    function setUp()
    {
        $this->factory = new BlockFactory;
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(BlockFactory::class, $this->factory);
    }

    /** @test */
    function it_makes_an_entity()
    {
        $block = $this->factory->make([
            'id' => 'dummy',
            'data' => file_get_contents($this->fixtures . '/blocks/dummy.md'),
        ]);

        $this->assertInstanceOf(Block::class, $block);
        $this->assertEquals('dummy', $block->getIdentifier());
        $this->assertRegexp('/## Hello world/', $block->body);
    }
}
