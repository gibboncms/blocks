<?php

namespace GibbonCms\Blocks;

use GibbonCms\Gibbon\Filesystems\FileCache;
use GibbonCms\Gibbon\Filesystems\Filesystem;
use GibbonCms\Gibbon\Modules\Module;
use GibbonCms\Gibbon\Repositories\FileRepository;

class Blocks implements Module
{
    /**
     * @var \GibbonCms\Gibbon\Repositories\Repository
     */
    protected $repository;

    /**
     * @param  \GibbonCms\Gibbon\Filesystems\Filesystem $filesystem
     * @param  string $directory
     * @param  \GibbonCms\Gibbon\Filesystems\FileCache $fileCache
     */
    public function __construct(Filesystem $filesystem, $directory, FileCache $fileCache)
    {
        $this->repository = new FileRepository($filesystem, $directory, $fileCache, new BlockFactory, true);
    }

    /**
     * @param  string $id
     * @return \GibbonCms\Blocks\Block
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param  string $id
     * @return \GibbonCms\Blocks\Block
     */
    public function contents($id)
    {
        $block = $this->repository->find($id);
        
        return isset($block) ? $block->body : null;
    }

    /**
     * @return void
     */
    public function setUp()
    {
        $this->repository->build();
    }
}
