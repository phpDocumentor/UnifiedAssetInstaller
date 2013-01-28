<?php

namespace phpDocumentor\Composer;

use Composer\Package\PackageInterface;

class UnifiedAssetInstaller extends \Composer\Installer\LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        if (substr($package->getPrettyName(), 0, 23) != 'phpdocumentor/template-') {
            throw new \InvalidArgumentException(
                'Unable to install template, phpdocumentor templates should '
                .'always start their package name with "phpdocumentor/template-"'
            );
        }

        if ($this->getVendorInstallPath()) {
            return $this->getVendorInstallPath() . '/' . substr($package->getPrettyName(), 23);
        } else {
            return 'data/templates/'.substr($package->getPrettyName(), 23);
        }
    }

    /**
     * Check and return the install path when installed as vendor
     * @return string
     */
    protected function getVendorInstallPath()
    {
        if (file_exists($this->vendorDir . '/phpdocumentor/phpdocumentor/composer.json')) {
            return $this->vendorDir . '/phpdocumentor/phpdocumentor/data/templates';
        }
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
      return (bool)('phpdocumentor-template' === $packageType);
    }
}
