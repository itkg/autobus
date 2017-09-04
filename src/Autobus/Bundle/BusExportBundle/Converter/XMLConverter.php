<?php

namespace Autobus\Bundle\BusExportBundle\Converter;

/**
 * class XMLConverter
 */
class XMLConverter extends SerializeConverter
{
    /**
     * @param string $format
     *
     * @return bool
     */
    public function supports($format)
    {
        return $format === 'text/xml';
    }
}
