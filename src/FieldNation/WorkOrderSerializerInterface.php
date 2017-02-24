<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


/**
 * Interface WorkOrderSerializerInterface
 * @package FieldNation
 */
interface WorkOrderSerializerInterface
{
    public function getGroup();
    public function getDescription();
    public function getLocation();
    public function getStartTime();
    public function getPayInfo();
    public function getAllowTechUploads();
    public function getWillAlertWhenPublished();
    public function getIsPrintable();
    public function getAdditionalFields();
    public function getLabels();
    public function getCloseoutRequirements();
}