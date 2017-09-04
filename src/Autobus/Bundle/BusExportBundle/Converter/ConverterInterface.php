<?php

namespace Autobus\Bundle\BusExportBundle\Converter;

/**
 * class ConverterInterface
 */
interface ConverterInterface
{
    /**
     * @param string $format
     *
     * @return bool
     */
    public function supports($format);

    /**
     * @param mixed $data
     * @param array $config
     *
     * @return mixed
     */
    public function convert($data, array $config = array());
}
