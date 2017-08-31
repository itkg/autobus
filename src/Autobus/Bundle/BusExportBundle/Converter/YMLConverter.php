<?php

namespace Autobus\Bundle\BusExportBundle\Converter;

/**
 * class YMLConverter
 */
class YMLConverter extends SerializeConverter
{
    protected $acceptedFormats = array(
        'text/yaml',
        'text/x-yaml',
        'application/yaml',
        'application/x-yaml'
    );

    /**
     * @param string $format
     *
     * @return bool
     */
    public function supports($format)
    {
        return in_array($format, $this->acceptedFormats);
    }
}
