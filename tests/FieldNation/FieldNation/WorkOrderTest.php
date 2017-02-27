<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation\Tests;


use FieldNation\ClientInterface;
use FieldNation\PayInfo;
use FieldNation\ServiceDescription;
use FieldNation\ServiceLocation;
use FieldNation\TimeRange;
use FieldNation\WorkOrder;
use FieldNation\WorkOrderInterface;


class WorkOrderTest extends \PHPUnit_Framework_TestCase
{
    private $clientMock;

    public function setUp()
    {
        $this->clientMock = $this->createMock(ClientInterface::class);
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
}
