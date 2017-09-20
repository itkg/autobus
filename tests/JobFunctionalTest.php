<?php

namespace Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JobFunctionalTest extends WebTestCase
{
    /**
     * @dataProvider crudDataProvider
     *
     * @param string $jobType
     * @param array $formValues
     */
    public function testCRUDJob($jobType, array $formValues)
    {
        $jobId = $this->createJob($jobType, $formValues);
        $this->deleteJob($jobId);
    }

    /**
     * @param string $jobType
     * @param array $formValues
     *
     * @return mixed
     */
    private function createJob($jobType, array $formValues)
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/job/new?job_type=' . $jobType);
        $this->assertEquals(
            'Autobus\Bundle\BusBundle\Controller\JobController::newAction',
            $client->getRequest()->attributes->get('_controller')
        );

        // Fill form with valid parameters
        $form = $crawler->selectButton('Sauvegarder')->form($formValues);

        // Submit new form
        $client->submit($form);
        $this->assertEquals(
            'Autobus\Bundle\BusBundle\Controller\JobController::newAction',
            $client->getRequest()->attributes->get('_controller')
        );

        $this->assertTrue($client->getResponse()->isRedirection());
        $client->followRedirect();
        $this->assertEquals(
            'Autobus\Bundle\BusBundle\Controller\JobController::showAction',
            $client->getRequest()->attributes->get('_controller')
        );

        return $client->getRequest()->attributes->get('id');
    }

    private function deleteJob($jobId)
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/job/' . $jobId . '/edit');

        $form = $crawler->selectButton('Supprimer')->form(array());

        // Submit delete form
        $client->submit($form);
        $this->assertEquals(
            'Autobus\Bundle\BusBundle\Controller\JobController::deleteAction',
            $client->getRequest()->attributes->get('_controller')
        );

        $this->assertTrue($client->getResponse()->isRedirection());
        $client->followRedirect();
        $this->assertEquals(
            'Autobus\Bundle\BusBundle\Controller\JobController::indexAction',
            $client->getRequest()->attributes->get('_controller')
        );

        // Check if edit results in not found as job was deleted
        $client->request('GET', '/job/' . $jobId . '/edit');
        $this->assertTrue($client->getResponse()->isNotFound());
    }

    public function crudDataProvider()
    {
        return array(
            array(
                'cron',
                array(
                    'AutobusBusBundle_job[name]'  => 'Cron Job',
                    'AutobusBusBundle_job[schedule]'  => '0 0 * * *',
                )
            ),
            array(
                'queue',
                array(
                    'AutobusBusBundle_job[name]'  => 'Queue Job',
                    'AutobusBusBundle_job[queue]' => 'queue',
                )
            ),
            array(
                'web',
                array(
                    'AutobusBusBundle_job[name]'  => 'Web Job',
                    'AutobusBusBundle_job[path]'  => 'path',
                )
            ),
        );
    }

    /**
     * @dataProvider jobTypeProvider
     *
     * @param string $jobType
     */
    public function testInvalidCreateJob($jobType)
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/job/new?job_type=' . $jobType);
        $this->assertEquals(
            'Autobus\Bundle\BusBundle\Controller\JobController::newAction',
            $client->getRequest()->attributes->get('_controller')
        );

        // Form is not filled with parameters
        $form = $crawler->selectButton('Sauvegarder')->form(array());

        // Submit new form
        $crawler = $client->submit($form);
        $this->assertEquals(
            'Autobus\Bundle\BusBundle\Controller\JobController::newAction',
            $client->getRequest()->attributes->get('_controller')
        );

        // Check if we have errors
        $this->assertGreaterThan(
            0,
            $crawler->filter('.has-error')->count()
        );
    }

    public function jobTypeProvider()
    {
        return array(
            array(
                'cron',
            ),
            array(
                'queue',
            ),
            array(
                'web',
            ),
        );
    }
}
