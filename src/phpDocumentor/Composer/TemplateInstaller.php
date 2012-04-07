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
        if (substr($package->getPrettyName(), 0, 23) != 'phpdocumentor/template.') {
            throw new \InvalidArgumentException(
                'Unable to install template, phpdocumentor templates should always start their package name with "phpdocumentor/template."'
            );
        }
        return 'data/templates/'.substr($package->getPrettyName(), 23);
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
      return (bool)('phpdocumentor-template' === $packageType);
    }
}
