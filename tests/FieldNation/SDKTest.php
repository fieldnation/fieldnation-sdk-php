<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation\Tests;

use FieldNation\ClientFactoryInterface;
use FieldNation\DocumentInterface;
use FieldNation\FactoryInjectorInterface;
use FieldNation\ProjectInterface;
use FieldNation\SDKCredentialsInterface;
use FieldNation\SDK;
use FieldNation\SDKInterface;
use FieldNation\ServiceInterface;
use FieldNation\ServicesFactoryInterface;
use FieldNation\ShipmentServiceInterface;
use FieldNation\WorkOrderInterface;
use FieldNation\WorkOrderSerializerInterface;
use FieldNation\WorkOrderServiceInterface;

class SDKTest extends \PHPUnit_Framework_TestCase
{
    private $sdk;
    private $login;
    private $injector;
    private $clientFactory;
    private $servicesFactory;
    private $workOrderService;
    private $projectService;
    private $shipmentService;
    private $documentService;

    public function setUp()
    {
        $this->login = $this->createMock(SDKCredentialsInterface::class);
        $this->login->setCustomerId(rand());
        $this->login->setApiKey('foo');
        $this->login->setEffectiveUser('bar');
        $this->injector = $this->createMock(FactoryInjectorInterface::class);
        $this->clientFactory = $this->createMock(ClientFactoryInterface::class);
        $this->servicesFactory = $this->createMock(ServicesFactoryInterface::class);
        $this->workOrderService = $this->createMock(WorkOrderServiceInterface::class);
        $this->projectService = $this->createMock(ServiceInterface::class);
        $this->shipmentService = $this->createMock(ShipmentServiceInterface::class);
        $this->documentService = $this->createMock(ServiceInterface::class);
        $this->injector->method('getServicesFactory')->willReturn($this->servicesFactory);
        $this->injector->method('getClientFactory')->willReturn($this->clientFactory);
        $this->servicesFactory
             ->method('getWorkOrderService')
             ->with($this->injector->getClientFactory())
             ->willReturn($this->workOrderService);
        $this->servicesFactory
             ->method('getProjectService')
             ->with($this->injector->getClientFactory())
             ->willReturn($this->projectService);
        $this->servicesFactory
             ->method('getShipmentService')
             ->with($this->injector->getClientFactory())
             ->willReturn($this->shipmentService);
        $this->servicesFactory
             ->method('getDocumentService')
             ->with($this->injector->getClientFactory())
             ->willReturn($this->documentService);
        $this->sdk = new SDK($this->login, $this->injector);
    }

    public function testCanGetWorkOrders()
    {
        $wo1 = $this->createMock(WorkOrderInterface::class);
        $wo2 = $this->createMock(WorkOrderInterface::class);
        $expected = array ($wo1, $wo2);
        $this->workOrderService
             ->expects($this->once())
             ->method('getAll')
             ->willReturn($expected);
        $actual = $this->sdk->getWorkOrders();
        $this->assertEquals($expected, $actual);
        foreach ($actual as $workOrder) {
            $this->assertInstanceOf(WorkOrderInterface::class, $workOrder);
        }
    }

    public function testCanCreateWorkOrder()
    {
        $wo = $this->createMock(WorkOrderSerializerInterface::class);
        $expected = $this->createMock(WorkOrderInterface::class);
        $this->workOrderService
             ->expects($this->once())
             ->method('createNew')
             ->with($wo)
             ->willReturn($expected);
        $actual = $this->sdk->createWorkOrder($wo);
        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf(WorkOrderInterface::class, $actual);
    }

    public function testCanGetExistingWorkOrder()
    {
        $id = rand();
        $expected = $this->createMock(WorkOrderInterface::class);
        $expected->method('getId')->willReturn($id);
        $this->workOrderService
             ->expects($this->once())
             ->method('getExisting')
             ->with($id)
             ->willReturn($expected);
        $actual = $this->sdk->getExistingWorkOrder($id);
        $this->assertEquals($expected, $actual);
        $this->assertEquals($actual->getId(), $id);
        $this->assertInstanceOf(WorkOrderInterface::class, $actual);
    }

    public function testCanGetProjects()
    {
        $project1 = $this->createMock(ProjectInterface::class);
        $project2 = $this->createMock(ProjectInterface::class);
        $expected = array($project1, $project2);
        $this->projectService
             ->expects($this->once())
             ->method('getAll')
             ->willReturn($expected);
        $actual = $this->sdk->getProjects();
        $this->assertEquals($expected, $actual);
        foreach ($actual as $project) {
            $this->assertInstanceOf(ProjectInterface::class, $project);
        }
    }

    public function testCanGetShippingIdFromTrackingNumber()
    {
        $trackingNumber = rand();
        $shippingId = rand();
        $this->shipmentService
             ->expects($this->once())
             ->method('toShippingId')
             ->with($trackingNumber)
             ->willReturn($shippingId);
        $actual = $this->sdk->getShippingIdFrom($trackingNumber);
        $this->assertEquals($shippingId, $actual);
    }

    public function testCanGetDocuments()
    {
        $doc1 = $this->createMock(DocumentInterface::class);
        $doc2 = $this->createMock(DocumentInterface::class);
        $expected = array($doc1, $doc2);
        $this->documentService
             ->expects($this->once())
             ->method('getAll')
             ->willReturn($expected);
        $actual = $this->sdk->getDocuments();
        $this->assertEquals($expected, $actual);
        foreach ($actual as $document) {
            $this->assertInstanceOf(DocumentInterface::class, $document);
        }
    }

    public function testCanCreateItsOwnDependencies()
    {
        $sdk = new SDK($this->login);
        $this->assertInstanceOf(SDKInterface::class, $sdk);
    }
}
