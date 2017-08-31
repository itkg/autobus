<?php

namespace Autobus\Bundle\BusExportBundle\EventListener;

use Autobus\Bundle\BusBundle\Event\RunnerEvents;
use Autobus\Bundle\BusBundle\Event\RunnerHandleEvent;
use Autobus\Bundle\BusExportBundle\Converter\ConverterChain;
use Autobus\Bundle\BusExportBundle\Runner\ExportRunnerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * class ExportHandlerSubscriber
 */
class ExportHandlerSubscriber implements EventSubscriberInterface
{
    /**
     * @var ConverterChain
     */
    private $converterChain;

    /**
     * @param ConverterChain $converterChain
     */
    public function __construct(ConverterChain $converterChain)
    {
        $this->converterChain = $converterChain;
    }
    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return array(
            RunnerEvents::SUCCESS => 'handleExport'
        );
    }

    /**
     * @param RunnerHandleEvent $event
     */
    public function handleExport(RunnerHandleEvent $event)
    {
        $runner = $event->getRunner();
        if (!$runner instanceof ExportRunnerInterface) {
            return;
        }
        $response = $event->getResponse();
        $convertedData = $this->converterChain->convert(
            $runner->getData(),
            $runner->getFormat(),
            $runner->getConfig()
        );

        $response->setContent($convertedData);
        $response->headers->set('Content-Type', $runner->getFormat());
    }
}
