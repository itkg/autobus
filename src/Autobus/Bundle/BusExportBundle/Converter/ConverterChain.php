<?php

namespace Autobus\Bundle\BusExportBundle\Converter;

/**
 * class ConverterChain
 */
final class ConverterChain
{
    /**
     * @var ConverterInterface[]
     */
    protected $converters = array();

    /**
     * @param ConverterInterface $converter
     */
    public function addConverter(ConverterInterface $converter)
    {
        $this->converters[] = $converter;
    }

    /**
     * @param mixed $data
     * @param mixed $format
     * @param array $config
     *
     * @return mixed
     */
    public function convert($data, $format, array $config = array())
    {

        foreach ($this->converters as $converter) {
            if ($converter->supports($format)) {
                return $converter->convert($data, $config);
            }
        }
    }
}
