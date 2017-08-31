<?php

namespace Autobus\Bundle\BusExportBundle\Converter;

/**
 * class CSVConverter
 */
class CSVConverter implements ConverterInterface
{
    /**
     * @param string $format
     *
     * @return bool
     */
    public function supports($format)
    {
        return $format === 'text/csv';
    }

    /**
     * @param mixed $data
     * @param array $config
     *
     * @return mixed
     */
    public function convert($data, array $config = array())
    {
        // TODO: Implement convert() method.
    }
}
