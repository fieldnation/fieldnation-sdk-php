<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation\Tests;

use FieldNation\AdditionalFieldInterface;
use FieldNation\ClientInterface;
use FieldNation\DocumentInterface;
use FieldNation\MessageInterface;
use FieldNation\PayInfoInterface;
use FieldNation\PaymentInterface;
use FieldNation\ProgressInterface;
use FieldNation\RecipientInterface;
use FieldNation\ResultInterface;
use FieldNation\ServiceDescriptionInterface;
use FieldNation\ServiceLocationInterface;
use FieldNation\ShipmentInterface;
use FieldNation\TechnicianInterface;
use FieldNation\TimeRangeInterface;
use FieldNation\WorkOrder;
use FieldNation\WorkOrderInterface;
use FieldNation\WorkOrderStatuses;

class WorkOrderTest extends \PHPUnit_Framework_TestCase
{
    private $clientMock;
    private $wo;
    private $woId;

    public function setUp()
    {
        $this->clientMock = $this->createMock(ClientInterface::class);
        $this->woId = rand();
        $this->wo = new WorkOrder($this->clientMock);
        $this->wo->setId($this->woId);
    }

    public function testWorkOrderCanBeCreated()
    {
        $this->assertInstanceOf(WorkOrderInterface::class, $this->wo);
    }

    public function testAllPropertiesCanBeSet()
    {
        $group = 'foo';
        $description = $this->createMock(ServiceDescriptionInterface::class);
        $location = $this->createMock(ServiceLocationInterface::class);
        $startTime = $this->createMock(TimeRangeInterface::class);
        $payInfo = $this->createMock(PayInfoInterface::class);
        $allowTechUploads = true;
        $willAlertWhenPublished = false;
        $isPrintable = true;
        $additionalFields = array();
        $labels = array('bar', 'baz');
        $closeoutRequirements = array();

        $this->wo->setGroup($group)
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

        $this->assertEquals($this->wo->getGroup(), $group);
        $this->assertEquals($this->wo->getDescription(), $description);
        $this->assertEquals($this->wo->getLocation(), $location);
        $this->assertEquals($this->wo->getStartTime(), $startTime);
        $this->assertEquals($this->wo->getPayInfo(), $payInfo);
        $this->assertEquals($this->wo->getAllowTechUploads(), $allowTechUploads);
        $this->assertEquals($this->wo->getIsPrintable(), $isPrintable);
        $this->assertEquals($this->wo->getAdditionalFields(), $additionalFields);
        $this->assertEquals($this->wo->getLabels(), $labels);
        $this->assertEquals($this->wo->getCloseoutRequirements(), $closeoutRequirements);
        $this->assertEquals($this->wo->getWillAlertWhenPublished(), $willAlertWhenPublished);
    }

    public function testCanGetTheWholeWorkOrder()
    {

        $this->wo->setId($this->woId);
        $this->clientMock
             ->expects($this->once())
             ->method('getWorkOrder')
             ->with($this->equalTo($this->woId))
             ->willReturn($this->wo);

        $expected = $this->wo->get();
        $this->assertEquals($expected, $this->wo);
        $this->assertInstanceOf(WorkOrderInterface::class, $this->wo);
    }

    public function testCanGetStatus()
    {
        $this->wo->setId($this->woId);
        $expected = array_rand(WorkOrderStatuses::getConstants());
        $this->clientMock
             ->expects($this->once())
             ->method('getWorkOrderStatus')
             ->with($this->equalTo($this->woId))
             ->willReturn($expected);
        $actual = $this->wo->getStatus();
        $this->assertEquals($expected, $actual);
    }

    public function testCanGetAssignedProvider()
    {
        $this->wo->setId($this->woId);
        $expected = $this->createMock(TechnicianInterface::class);
        $expected->method('getFirstName')->willReturn('Best');
        $expected->method('getLastName')->willReturn('Tech');
        $this->clientMock
             ->expects($this->once())
             ->method('getWorkOrderAssignedProvider')
             ->with($this->equalTo($this->woId))
             ->willReturn($expected);
        $actual = $this->wo->getAssignedProvider();
        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf(TechnicianInterface::class, $actual);
        $this->assertEquals($expected->getFirstName(), $actual->getFirstName());
        $this->assertEquals($expected->getLastName(), $actual->getLastName());
    }

    public function testCanGetProgress()
    {
        $this->wo->setId($this->woId);
        $expected = $this->createMock(ProgressInterface::class);
        $expected->method('getIsReadyToGo')->willReturn(false);
        $expected->method('getTotalDevices')->willReturn(10);
        $expected->method('getTotalHours')->willReturn(10.0);
        $assignedProvider = $this->createMock(TechnicianInterface::class);
        $assignedProvider->method('getId')->willReturn(100);
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
        $actual = $this->wo->getProgress();
        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf(ProgressInterface::class, $actual);
    }

    public function testCanGetPayment()
    {
        $this->wo->setId($this->woId);
        $expected = $this->createMock(PaymentInterface::class);
        $this->clientMock
            ->expects($this->once())
            ->method('getWorkOrderPayment')
            ->with($this->equalTo($this->woId))
            ->willReturn($expected);
        $actual = $this->wo->getPayment();
        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf(PaymentInterface::class, $actual);
    }

    public function testCanGetMessages()
    {
        $this->wo->setId($this->woId);
        $m1 = $this->createMock(MessageInterface::class);
        $m2 = $this->createMock(MessageInterface::class);
        $expected = array($m1, $m2);
        $this->clientMock
            ->expects($this->once())
            ->method('getWorkOrderMessages')
            ->with($this->equalTo($this->woId))
            ->willReturn($expected);
        $actual = $this->wo->getMessages();
        $this->assertEquals($expected, $actual);
        $this->assertInternalType('array', $actual);
        foreach ($actual as $message) {
            $this->assertInstanceOf(MessageInterface::class, $message);
        }
    }

    public function testCanGetAttachedDocuments()
    {
        $this->wo->setId($this->woId);
        $doc1 = $this->createMock(DocumentInterface::class);
        $doc2 = $this->createMock(DocumentInterface::class);
        $expected = array($doc1, $doc2);
        $this->clientMock
            ->expects($this->once())
            ->method('getWorkOrderAttachedDocuments')
            ->with($this->equalTo($this->woId))
            ->willReturn($expected);
        $actual = $this->wo->getAttachedDocuments();
        $this->assertEquals($expected, $actual);
        foreach ($actual as $attachment) {
            $this->assertInstanceOf(DocumentInterface::class, $attachment);
        }
    }

    public function testCanGetShipments()
    {
        $this->wo->setId($this->woId);
        $ship1 = $this->createMock(ShipmentInterface::class);
        $ship2 = $this->createMock(ShipmentInterface::class);
        $expected = array($ship1, $ship2);
        $this->clientMock
            ->expects($this->once())
            ->method('getWorkOrderShipments')
            ->with($this->equalTo($this->woId))
            ->willReturn($expected);
        $actual = $this->wo->getShipments();
        $this->assertEquals($expected, $actual);
        foreach ($actual as $shipment) {
            $this->assertInstanceOf(ShipmentInterface::class, $shipment);
        }
    }

    public function testCanCreate()
    {
        $expected = $this->wo;
        $this->clientMock
            ->expects($this->once())
            ->method('createWorkOrder')
            ->with($this->equalTo($expected))
            ->willReturn($expected);
        $actual = $this->wo->create();
        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf(WorkOrderInterface::class, $actual);
    }

    public function testCanPublish()
    {
        $expected = $this->createMock(ResultInterface::class);
        $expected->method('getMessage')->willReturn('Published');
        $this->clientMock
            ->expects($this->once())
            ->method('publishWorkOrder')
            ->with($this->equalTo($this->wo->getId()))
            ->willReturn($expected);
        $actual = $this->wo->publish();
        $this->assertEquals($expected, $actual);
        $this->assertEquals('Published', $actual->getMessage());
        $this->assertInstanceOf(ResultInterface::class, $actual);
    }

    public function testCanRouteToProvider()
    {
        $tech = $this->createMock(RecipientInterface::class);
        $tech->method('isProvider')->willReturn(true);
        $expected = $this->createMock(ResultInterface::class);
        $this->clientMock
            ->expects($this->once())
            ->method('routeWorkOrderToProvider')
            ->with(
                $this->equalTo($this->wo->getId()),
                $this->equalTo($tech->getId())
            )
            ->willReturn($expected);
        $actual = $this->wo->routeTo($tech);
        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf(ResultInterface::class, $actual);
    }

    public function testCanRouteToGroup()
    {
        $group = $this->createMock(RecipientInterface::class);
        $group->method('isGroup')->willReturn(true);
        $expected = $this->createMock(ResultInterface::class);
        $this->clientMock
            ->expects($this->once())
            ->method('routeWorkOrderToGroup')
            ->with(
                $this->equalTo($this->wo->getId()),
                $this->equalTo($group->getId())
            )
            ->willReturn($expected);
        $actual = $this->wo->routeTo($group);
        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf(ResultInterface::class, $actual);
    }

    public function testWillReturnFailureIfRecipientIsUnknown()
    {
        $stubRecipient = $this->createMock(RecipientInterface::class);
        $stubRecipient->method('isGroup')->willReturn(false);
        $stubRecipient->method('isProvider')->willReturn(false);
        $wo = new WorkOrder($this->clientMock);
        $wo->setId($this->woId);
        $actual = $wo->routeTo($stubRecipient);
        $this->assertFalse($actual->wasSuccessful());
    }

    public function testCanApprove()
    {
        $expected = $this->createMock(ResultInterface::class);
        $wo = new WorkOrder($this->clientMock);
        $wo->setId($this->woId);
        $this->clientMock
            ->expects($this->once())
            ->method('approveWorkOrder')
            ->with($this->woId)
            ->willReturn($expected);
        $actual = $wo->approve();
        $this->assertEquals($expected, $actual);
    }

    public function testCanCancel()
    {
        $expected = $this->createMock(ResultInterface::class);
        $willAcceptFees = true;
        $reason = null;
        $this->clientMock
            ->expects($this->once())
            ->method('cancelWorkOrder')
            ->with(
                $this->wo->getId(),
                $willAcceptFees,
                $reason
            )
            ->willReturn($expected);

        $actual = $this->wo->cancel($willAcceptFees, $reason);
        $this->assertEquals($expected, $actual);
    }

    public function testCanAttachDocument()
    {
        $documentStub = $this->createMock(DocumentInterface::class);
        $documentStub->method('getId')->willReturn(rand());
        $expected = $this->createMock(ResultInterface::class);
        $this->clientMock
            ->expects($this->once())
            ->method('attachDocumentToWorkOrder')
            ->with(
                $this->wo->getId(),
                $documentStub->getId()
            )
            ->willReturn($expected);
        $actual = $this->wo->attach($documentStub);
        $this->assertEquals($expected, $actual);
    }

    public function testCanDetachDocument()
    {
        $documentStub = $this->createMock(DocumentInterface::class);
        $documentStub->method('getId')->willReturn(rand());
        $expected = $this->createMock(ResultInterface::class);
        $this->clientMock
            ->expects($this->once())
            ->method('detachDocumentFromWorkOrder')
            ->with(
                $this->wo->getId(),
                $documentStub->getId()
            )
            ->willReturn($expected);
        $actual = $this->wo->detach($documentStub);
        $this->assertEquals($expected, $actual);
    }

    public function testCanAddMessage()
    {
        $messageStub = $this->createMock(MessageInterface::class);
        $messageStub->method('getMessage')->willReturn('Foo');
        $messageStub->method('getMode')->willReturn(rand());
        $expected = $this->createMock(ResultInterface::class);
        $this->clientMock
            ->expects($this->once())
            ->method('addMessageToWorkOrder')
            ->with(
                $this->wo->getId(),
                $messageStub->getMessage(),
                $messageStub->getMode()
            )
            ->willReturn($expected);
        $actual = $this->wo->addMessage($messageStub);
        $this->assertEquals($expected, $actual);
    }

    public function testCanAddAdditionalField()
    {
        $fieldStub = $this->createMock(AdditionalFieldInterface::class);
        $fieldStub->method('getName')->willReturn('Custom Field');
        $fieldStub->method('getValue')->willReturn('Foo');
        $expected = $this->createMock(ResultInterface::class);
        $this->clientMock
            ->expects($this->once())
            ->method('setCustomFieldOnWorkOrder')
            ->with(
                $this->wo->getId(),
                $fieldStub->getName(),
                $fieldStub->getValue()
            )
            ->willReturn($expected);
        $actual = $this->wo->addAdditionalField($fieldStub);
        $this->assertEquals($expected, $actual);
    }

    public function testCanAddLabel()
    {
        $label = 'foo';
        $expected = $this->createMock(ResultInterface::class);
        $this->clientMock
            ->expects($this->once())
            ->method('setLabelOnWorkOrder')
            ->with(
                $this->wo->getId(),
                $label
            )
            ->willReturn($expected);
        $actual = $this->wo->addLabel($label);
        $this->assertEquals($expected, $actual);
    }

    public function testCanRemoveLabel()
    {
        $label = 'foo';
        $expected = $this->createMock(ResultInterface::class);
        $this->clientMock
            ->expects($this->once())
            ->method('unsetLabelOnWorkOrder')
            ->with(
                $this->wo->getId(),
                $label
            )
            ->willReturn($expected);
        $actual = $this->wo->removeLabel($label);
        $this->assertEquals($expected, $actual);
    }

    public function testCanSatisfyCloseoutRequest()
    {
        $closeoutReq = 'foo';
        $expected = $this->createMock(ResultInterface::class);
        $this->clientMock
            ->expects($this->once())
            ->method('satisfyCloseoutOnWorkOrder')
            ->with(
                $this->wo->getId(),
                $closeoutReq
            )
            ->willReturn($expected);
        $actual = $this->wo->satisfyCloseoutRequest($closeoutReq);
        $this->assertEquals($expected, $actual);
    }

    public function testCanDeleteShipment()
    {
        $shipmentStub = $this->createMock(ShipmentInterface::class);
        $shipmentStub->method('getId')->willReturn(rand());
        $expected = $this->createMock(ResultInterface::class);
        $this->clientMock
            ->expects($this->once())
            ->method('deleteShipment')
            ->with($shipmentStub->getId())
            ->willReturn($expected);
        $actual = $this->wo->deleteShipment($shipmentStub);
        $this->assertEquals($expected, $actual);
    }
    
    public function testCanAddShipment()
    {
        $shipmentStub = $this->createMock(ShipmentInterface::class);
        $shipmentStub->method('getId')->willReturn(rand());
        $expected = $this->createMock(ResultInterface::class);
        $this->clientMock
            ->expects($this->once())
            ->method('addShipment')
            ->with(
                $this->wo->getId(),
                $shipmentStub
            )
            ->willReturn($expected);
        $actual = $this->wo->addShipment($shipmentStub);
        $this->assertEquals($expected, $actual);
    }

    public function testCanUpdateSchedule()
    {
        $scheduleStub = $this->createMock(TimeRangeInterface::class);
        $expected = $this->createMock(ResultInterface::class);
        $this->clientMock
            ->expects($this->once())
            ->method('updateWorkOrderSchedule')
            ->with(
                $this->wo->getId(),
                $scheduleStub
            )
            ->willReturn($expected);
        $actual = $this->wo->updateSchedule($scheduleStub);
        $this->assertEquals($expected, $actual);
    }
}
