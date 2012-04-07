<?php

namespace phpDocumentor\Composer;

use Composer\Package\PackageInterface;
use Composer\IO\NullIO;
use Composer\Downloader\DownloadManager;
use Composer\Repository\WritableRepositoryInterface;

class TemplateInstaller extends \Composer\Installer\LibraryInstaller
{
    /**
     * Override constructor to pass 5th parameter
     */
    public function __construct($vendorDir, $binDir, DownloadManager $dm, WritableRepositoryInterface $repository)
    {
      parent::__construct($vendorDir, $binDir, $dm, $repository, new NullIO());
    }

    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        var_dump($package->getPrettyName());
        var_dump(ltrim($package->getPrettyName(), 'phpdocumentor/template.'));
        return 'data/templates/'
            .ltrim($package->getPrettyName(), 'phpdocumentor/template.');
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
      return (bool)('phpdocumentor-template' === $packageType);
    }
}
