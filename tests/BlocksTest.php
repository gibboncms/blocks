<?php

namespace GibbonCms\Blocks\Test;

use GibbonCms\Blocks\Blocks;
use GibbonCms\Blocks\Block;

class BlocksTest extends TestCase
{
    function setUp()
    {
        $this->blocks = new Blocks($this->fixtures . '/blocks');
        $this->blocks->setUp();
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(Blocks::class, $this->blocks);
    }

    /** @test */
    function it_gets_a_page()
    {
        $this->assertInstanceOf(Block::class, $this->blocks->find('dummy'));
    }

    /** @tes */
    function it_gets_all_blocks()
    {
        $this->assertCount(1, $this->blocks->getAll());
    }
}
