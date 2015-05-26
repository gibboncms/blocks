<?php

namespace GibbonCms\Blocks;

use GibbonCms\Gibbon\Filesystems\FileCache;
use GibbonCms\Gibbon\Filesystems\PlainFilesystem;
use GibbonCms\Gibbon\Modules\Module;
use GibbonCms\Gibbon\Repositories\FileRepository;

class Blocks implements Module
{
    /**
     * @var \GibbonCms\Gibbon\Repository
     */
    protected $repository;

    /**
     * @param string $directory
     */
    public function __construct($directory)
    {
        $this->repository = new FileRepository(
            new PlainFilesystem($directory),
            new FileCache($directory . '/.cache'),
            new BlockFactory
        );
    }

    /**
     * @param string $id
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
