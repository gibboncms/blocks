<?php

namespace GibbonCms\Blocks\Test;

use GibbonCms\Blocks\Blocks;
use GibbonCms\Blocks\Block;
use GibbonCms\Gibbon\Filesystems\PlainFilesystem;
use GibbonCms\Gibbon\Filesystems\FileCache;

class BlocksTest extends TestCase
{
    function setUp()
    {
        $this->blocks = new Blocks(
            new PlainFilesystem($this->fixtures),
            'blocks',
            new FileCache($this->fixtures.'/blocks/.cache')
        );

        $this->blocks->setUp();
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(Blocks::class, $this->blocks);
    }

    /** @test */
    function it_gets_a_block()
    {
        $this->assertInstanceOf(Block::class, $this->blocks->get('dummy'));
    }

    /** @test */
    function it_gets_a_headless_block()
    {
        $this->assertInstanceOf(Block::class, $this->blocks->get('headless'));
    }

    /** @test */
    function it_gets_a_blocks_contents()
    {
        $this->assertContains('## Hello world', $this->blocks->contents('dummy'));
    }

    /** @test */
    function it_gets_a_headless_blocks_contents()
    {
        $this->assertContains('I have no head.', $this->blocks->contents('headless'));
    }
}
