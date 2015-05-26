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
        $this->assertRegexp('/<div class="block" id="block-hello-world">/', $block->render());
        $this->assertRegexp('/<h2>Hello world<\/h2>/', $block->render());
        $this->assertRegexp('/<\/div>/', $block->render());
        $this->assertRegexp('/<section class="block" id="block-hello-world">/', $block->render('section'));
        $this->assertRegexp('/<\/section>/', $block->render('section'));
    }

    /** @test */
    function it_encodes_an_entity()
    {
        $block = $this->factory->make([
            'id' => 'dummy',
            'data' => file_get_contents($this->fixtures . '/blocks/dummy.md'),
        ]);

        $raw = $this->factory->encode($block);

        $this->assertEquals(file_get_contents($this->fixtures . '/blocks/dummy.md'), $raw);
    }
}
