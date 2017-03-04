<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class WorkOrderStatuses extends AbstractAttribute
{
    const CREATED = 'Created';
    const PUBLISHED = 'Published';
    const ROUTED = 'Routed';
    const ASSIGNED = 'Assigned';
    const WORK_DONE = 'Work Done';
    const APPROVED = 'Approved';
    const PAID = 'Paid';
    const CANCELLED = 'Cancelled';
}
