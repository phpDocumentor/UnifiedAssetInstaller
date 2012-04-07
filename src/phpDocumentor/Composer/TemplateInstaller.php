<?php

namespace phpDocumentor\Composer;

use Composer\Package\PackageInterface;

class TemplateInstaller extends \Composer\Installer\LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
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
