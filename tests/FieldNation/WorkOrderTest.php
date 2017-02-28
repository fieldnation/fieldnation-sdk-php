<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation\Tests;

use FieldNation\ClientInterface;
use FieldNation\Document;
use FieldNation\DocumentInterface;
use FieldNation\Message;
use FieldNation\MessageInterface;
use FieldNation\PayInfo;
use FieldNation\Payment;
use FieldNation\PaymentInterface;
use FieldNation\Progress;
use FieldNation\ProgressInterface;
use FieldNation\ResultInterface;
use FieldNation\ServiceDescription;
use FieldNation\ServiceLocation;
use FieldNation\Shipment;
use FieldNation\ShipmentInterface;
use FieldNation\SuccessResult;
use FieldNation\Technician;
use FieldNation\TechnicianInterface;
use FieldNation\TimeRange;
use FieldNation\WorkOrder;
use FieldNation\WorkOrderInterface;
use FieldNation\WorkOrderStatuses;

class WorkOrderTest extends \PHPUnit_Framework_TestCase
{
    private $clientMock;
    private $woId;

    public function setUp()
    {
        $this->clientMock = $this->createMock(ClientInterface::class);
        $this->woId = rand();
    }

    public function testWorkOrderCanBeCreated()
    {
        $this->assertInstanceOf(WorkOrderInterface::class, new WorkOrder($this->clientMock));
    }

    public function testAllPropertiesCanBeSet()
    {
        $group = 'foo';
        $description = new ServiceDescription();
        $location = new ServiceLocation();
        $startTime = new TimeRange();
        $payInfo = new PayInfo();
        $allowTechUploads = true;
        $willAlertWhenPublished = false;
        $isPrintable = true;
        $additionalFields = array();
        $labels = array('bar', 'baz');
        $closeoutRequirements = array();

        $wo = new WorkOrder($this->clientMock);
        $wo->setGroup($group)
           ->setDescription($description)
           ->setLocation($location)
           ->setStartTime($startTime)
           ->setPayInfo($payInfo)
           ->setAllowTechUploads($allowTechUploads)
           ->setWillAlertWhenPublished($willAlertWhenPublished)
           ->setIsPrintable($isPrintable)
           ->setAdditionalFields($additionalFields)
           ->setLabels($labels)
           ->setCloseoutRequirements($closeoutRequirements);

        $this->assertEquals($wo->getGroup(), $group);
        $this->assertEquals($wo->getDescription(), $description);
        $this->assertEquals($wo->getLocation(), $location);
        $this->assertEquals($wo->getStartTime(), $startTime);
        $this->assertEquals($wo->getPayInfo(), $payInfo);
        $this->assertEquals($wo->getAllowTechUploads(), $allowTechUploads);
        $this->assertEquals($wo->getIsPrintable(), $isPrintable);
        $this->assertEquals($wo->getAdditionalFields(), $additionalFields);
        $this->assertEquals($wo->getLabels(), $labels);
        $this->assertEquals($wo->getCloseoutRequirements(), $closeoutRequirements);
    }

    public function testCanGetTheWholeWorkOrder()
    {
        $wo = new WorkOrder($this->clientMock);
        $wo->setId($this->woId);
        $this->clientMock
             ->expects($this->once())
             ->method('getWorkOrder')
             ->with($this->equalTo($this->woId))
             ->willReturn($wo);

        $expected = $wo->get();
        $this->assertEquals($expected, $wo);
        $this->assertInstanceOf(WorkOrderInterface::class, $wo);
    }

    public function testCanGetStatus()
    {
        $wo = new WorkOrder($this->clientMock);
        $wo->setId($this->woId);
        $expected = array_rand(WorkOrderStatuses::getConstants());
        $this->clientMock
             ->expects($this->once())
             ->method('getWorkOrderStatus')
             ->with($this->equalTo($this->woId))
             ->willReturn($expected);
        $actual = $wo->getStatus();
        $this->assertEquals($expected, $actual);
    }

    public function testCanGetAssignedProvider()
    {
        $wo = new WorkOrder($this->clientMock);
        $wo->setId($this->woId);
        $expected = new Technician();
        $expected->setFirstName('Best');
        $expected->setLastName('Tech');
        $this->clientMock
             ->expects($this->once())
             ->method('getWorkOrderAssignedProvider')
             ->with($this->equalTo($this->woId))
             ->willReturn($expected);
        $actual = $wo->getAssignedProvider();
        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf(TechnicianInterface::class, $actual);
        $this->assertEquals($expected->getFirstName(), $actual->getFirstName());
        $this->assertEquals($expected->getLastName(), $actual->getLastName());
    }

    public function testCanGetProgress()
    {
        $wo = new WorkOrder($this->clientMock);
        $wo->setId($this->woId);
        $expected = new Progress();
        $expected->setIsReadyToGo(false);
        $expected->setTotalDevices(10);
        $expected->setTotalHours(10.0);
        $assignedProvider = new Technician();
        $assignedProvider->setId(100);
        $this->clientMock
             ->expects($this->once())
             ->method('getWorkOrderAssignedProvider')
             ->with($this->equalTo($this->woId))
             ->willReturn($assignedProvider);
        $this->clientMock
             ->expects($this->once())
             ->method('getWorkOrderProgress')
             ->with(
                 $this->equalTo($this->woId),
                 $this->equalTo($assignedProvider->getId())
             )
             ->willReturn($expected);
        $actual = $wo->getProgress();
        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf(ProgressInterface::class, $actual);
    }

    public function testCanGetPayment()
    {
        $wo = new WorkOrder($this->clientMock);
        $wo->setId($this->woId);
        $expected = new Payment();
        $this->clientMock
            ->expects($this->once())
            ->method('getWorkOrderPayment')
            ->with($this->equalTo($this->woId))
            ->willReturn($expected);
        $actual = $wo->getPayment();
        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf(PaymentInterface::class, $actual);
    }

    public function testCanGetMessages()
    {
        $wo = new WorkOrder($this->clientMock);
        $wo->setId($this->woId);
        $m1 = new Message();
        $m1->setMessage('Foo');
        $m2 = new Message();
        $m2->setMessage('Bar');
        $expected = array($m1, $m2);
        $this->clientMock
            ->expects($this->once())
            ->method('getWorkOrderMessages')
            ->with($this->equalTo($this->woId))
            ->willReturn($expected);
        $actual = $wo->getMessages();
        $this->assertEquals($expected, $actual);
        $this->assertInternalType('array', $actual);
        foreach ($actual as $message) {
            $this->assertInstanceOf(MessageInterface::class, $message);
        }
    }

    public function testCanGetAttachedDocuments()
    {
        $wo = new WorkOrder($this->clientMock);
        $wo->setId($this->woId);
        $doc1 = new Document();
        $doc2 = new Document();
        $expected = array($doc1, $doc2);
        $this->clientMock
            ->expects($this->once())
            ->method('getWorkOrderAttachedDocuments')
            ->with($this->equalTo($this->woId))
            ->willReturn($expected);
        $actual = $wo->getAttachedDocuments();
        $this->assertEquals($expected, $actual);
        foreach ($actual as $attachment) {
            $this->assertInstanceOf(DocumentInterface::class, $attachment);
        }
    }

    public function testCanGetShipments()
    {
        $wo = new WorkOrder($this->clientMock);
        $wo->setId($this->woId);
        $ship1 = new Shipment();
        $ship2 = new Shipment();
        $expected = array($ship1, $ship2);
        $this->clientMock
            ->expects($this->once())
            ->method('getWorkOrderShipments')
            ->with($this->equalTo($this->woId))
            ->willReturn($expected);
        $actual = $wo->getShipments();
        $this->assertEquals($expected, $actual);
        foreach ($actual as $shipment) {
            $this->assertInstanceOf(ShipmentInterface::class, $shipment);
        }
    }

    public function testCanCreate()
    {
        $wo = new WorkOrder($this->clientMock);
        $expected = $wo;
        $this->clientMock
            ->expects($this->once())
            ->method('createWorkOrder')
            ->with($this->equalTo($expected))
            ->willReturn($expected);
        $actual = $wo->create();
        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf(WorkOrderInterface::class, $actual);
    }

    public function testCanPublish()
    {
        $wo = new WorkOrder($this->clientMock);
        $expected = new SuccessResult('Published');
        $this->clientMock
            ->expects($this->once())
            ->method('publishWorkOrder')
            ->with($this->equalTo($wo->getId()))
            ->willReturn($expected);
        $actual = $wo->publish();
        $this->assertEquals($expected, $actual);
        $this->assertEquals('Published', $actual->getMessage());
        $this->assertInstanceOf(ResultInterface::class, $actual);
    }

    public function testCanRouteToProvider()
    {
        $wo = new WorkOrder($this->clientMock);

        $expected = new SuccessResult('Routed to Provider');
    }

    public function testCanRouteToGroup()
    {
    }
}
