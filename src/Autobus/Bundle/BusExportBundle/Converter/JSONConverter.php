<?php

namespace Autobus\Bundle\BusExportBundle\Converter;

/**
 * class JSONConverter
 */
class JSONConverter extends SerializeConverter
{
    /**
     * @param string $format
     *
     * @return bool
     */
    public function supports($format)
    {
        return $format === 'application/json';
    }
}
