<?php

namespace GibbonCms\Blocks;

use GibbonCms\Gibbon\Filesystems\FileCache;
use GibbonCms\Gibbon\Filesystems\Filesystem;
use GibbonCms\Gibbon\Modules\Module;
use GibbonCms\Gibbon\Repositories\FileRepository;

class Blocks implements Module
{
    /**
     * @var \GibbonCms\Gibbon\Repository
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
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @return void
     */
    public function setUp()
    {
        $this->repository->build();
    }
}
