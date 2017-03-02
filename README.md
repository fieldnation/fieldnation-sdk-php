![Field Nation Logo](images/logo.png)
# Field Nation PHP SDK
* [Build Status](#build-status)
* [Installation](#installation)
    * [PHP Support](#php-support)
    * [PHP Requirements](#php-requirements)
    * [Installation with Composer](#installation-with-composer)
* [Usage](#usage)
    * [Authentication](#authentication)
    * [Create a Work Order](#create-a-work-order)
    * [Work Order Actions and Metadata](#work-order-actions)
        * [Publish](#publish)
        * [Route to Provider](#route-to-provider)
        * [Route to Group](#route-to-group)
        * [Approve](#approve)
        * [Cancel](#cancel)
        * [Attach Documents](#attach-documents)
        * [Detach Documents](#detach-documents)
        * [Add a Message](#add-a-message)
        * [Add a Custom Field](#add-a-custom-field)
        * [Add a Label](#add-a-label)
        * [Remove a Label](#remove-a-label)
        * [Resolving a Closeout Requirements](#resolving-a-closeout-requirements)
        * [Add a Shipment](#add-a-shipment)
        * [Delete a Shipment](#delete-a-shipment)
        * [Update Schedule](#update-schedule)
        * [Get the Entire Work Order](#get-the-entire-work-order)
        * [Get the Status](#get-the-status)
        * [Get the Assigned Provider](#get-the-assigned-provider)
        * [Get Progress](#get-progress)
        * [Get Payment](#get-payment)
        * [Get Messages](#get-messages)
        * [Get Attached Documents](#get-attached-documents)
        * [Get Shipments](#get-shipments)
    * [Get Your Work Orders](#get-your-work-orders)
    * [Get Your Projects](#get-your-projects)
    * [Get Your Documents](#get-your-documents)
    * [Convert a Tracking Number to a Shipping ID](#convert-a-tracking-number-to-a-shipping-id)
    * [Using Your Classes](#using-your-classes)
* [Contributing](#contributing)
    * [Tests](#tests)
    * [Coding Standards](#coding-standards)
* [Changelog](#changelog)
* [License](#license)
    
## Build Status
[![Build Status](https://jnkns.fndev.net/job/fieldnation-php-sdk/badge/icon)](https://jnkns.fndev.net/job/fieldnation-php-sdk/)

## Installation

### PHP Support
* PHP 5.6+
* PHP 7+
* HHVM

### PHP Requirements
Your php runtime needs to have [Soap](http://php.net/manual/en/book.soap.php) enabled.
Follow the [installation instructions](http://php.net/manual/en/soap.setup.php) for enabling the Soap module.

### Installation with Composer
Require the `fieldnation/fieldnation-sdk` package in your project.
```shell
$ composer require fieldnation/fieldnation-sdk
```

## Usage
The key concept to successfully integrating with Field Nation is describing how your business objects
become Field Nation objects. We provide interfaces for describing how your data can be
created on Field Nation.

### Authentication
To use the SDK you need to generate an API key for your company.
You can create an API key at `https://app.fieldnation.com/api`. Once you have a key you can create a connection.
```php
<?php
$fnCompanyId = $_ENV['FIELD_NATION_COMPANY_ID'];
$fnApiKey = $_ENV['FIELD_NATION_API_KEY'];
$fnEffectiveUser = $_ENV['FIELD_NATION_EFFECTIVE_USER']; // optional - First admin user will be used if not provided.
$credentials = new \FieldNation\LoginCredentials($fnCompanyId, $fnApiKey, $fnEffectiveUser);
$fn = new \FieldNation\SDK($credentials);
````

### Create a Work Order
First, let's create a simple example of what _your_ data model _might_ look like.

```php
<?php

class MyBusinessTicket
{
    private $id;
    private $title;
    private $description;
    private $startDateTime;
    
    // ... setters and getters for the properties
}
```

Now that we have our business logic in our `MyBusinessTicket`, how can we start creating work orders
on Field Nation? Simple -- we update `MyBusinessTicket` to implement `FieldNation\WorkOrderSerializerInterface` 
(or better yet, create a new class `MyFieldNationBusinessTicket` that extends `MyBusinessTicket` and implements 
`FieldNation\WorkOrderSerializerInterface`).

```php
<?php

use FieldNation\WorkOrderSerializerInterface;

class MyBusinessTicket implements WorkOrderSerializerInterface
{
    private $id;
    private $title;
    private $description;
    private $startDateTime;
    private $fieldNationId;
    
    // ... setters and getters for the properties
    
    // WorkOrderSerializerInterface methods
    
    /**
     * Get the name of the project the work order should be a member of.
     *
     * If not present, the work order will not belong to a project (default behavior).
     * If the project does not already exist, it will be created automatically and your effectiveUser
     * (See Login structure) will be the default manager for all newly-created projects.
     *
     * @return string
     */
    public function getGroup()
    {
        return NULL;
    }
    
    /**
     * Get the general descriptive information relevant to the job.
     *
     * @return FieldNation\ServiceDescriptionInterface
     */
    public function getDescription()
    {
        $description = new \FieldNation\ServiceDescription();
        $description->setCategoryId(1); // See docs for category IDs
        $description->setTitle($this->title);
        $description->setDescription($this->description);
        return $description;
    }
    
    /**
     * Get where the job site is located.
     *
     * @return FieldNation\ServiceLocationInterface
     */
    public function getLocation()
    {
        // My business only has one service location
        $locationType = \FieldNation\LocationTypes::COMMERCIAL;
        $location = new \FieldNation\ServiceLocation();
        $location->setType($locationType);
        $location->setName('Foo Co');
        $location->setAddress1('123 Main Street');
        $location->setCity('Minneapolis');
        $location->setState('MN');
        $location->setPostalCode('55402');
        $location->setCountry('US');
        $location->setContactName('Bob');
        $location->setContactEmail('bob@mybusiness.com');
        $location->setContactPhone('612-555-3485');
        return $location;
    }
    
    /**
     * Get scheduling information for the Work Order, including any applicable end time.
     *
     * @return FieldNation\TimeRangeInterface
     */
    public function getStartTime()
    {
        $time = new \FieldNation\TimeRange();
        $time->setTimeBegin($this->startDateTime);
        return $time;
    }
    
    /**
     * Get payment details to be advertised on the Work Order.
     * @return FieldNation\PayInfoInterface
     */
    public function getPayInfo()
    {
        // All of our tickets are a flat $20 rate with a 5 hour max
        $info = new \FieldNation\PayInfo();
        $rate = new \FieldNation\RatePay();
        $rate->setRate(20.0);
        $rate->setMaxUnits(5.0);
        $info->setPerHour($rate);
        return $info;
    }
    
    /**
     * Get whether to allow the technician to upload files to the Work Order.
     * If enabled, this Work Order will inherit required items from the project
     * it belongs to or settings your company has configured for all Work Orders.
     *
     * @return boolean
     */
    public function getAllowTechUploads()
    {
        // We always allow
        return true;
    }
    
    /**
     * Get whether to email any providers about the Work Order.
     * Typical usage is true and should only be disabled in certain circumstances.
     *
     * @return boolean
     */
    public function getWillAlertWhenPublished()
    {
        // Always alert providers
        return true;
    }

    /**
     * Get whether to grant technician access to a print-friendly version of work order details.
     * It is strongly recommended this is set to true. This should only be set false
     * if you will be attaching a printable version as a document.
     *
     * @return boolean
     */
    public function getIsPrintable()
    {
        // Always allow to print
        return true;
    }
    
    /**
     * Get additional fields (custom fields) and values provided by your company for the Work Order.
     *
     * @return FieldNation\AdditionalFieldInterface[]
     */
    public function getAdditionalFields()
    {
        // Add my 'TicketId' custom field to all work orders
        $ticketId = new \FieldNation\AdditionalField();
        $ticketId->setName('Ticket ID');
        $ticketId->setValue($this->id);
        
        return array($ticketId);
    }
    
    /**
     * Get labels that are set on the work order.
     *
     * @return string[]
     */
    public function getLabels()
    {
        return array();
    }
    
    /**
     * Get a list of requirements to be met before the Work Order is able to be marked Work Done.
     * Currently only configured and satisfied via the API. Should be NULL if not configured.
     *
     * @return array|NULL
     */
    public function getCloseoutRequirements()
    {
        return NULL;
    }
}
```

Let's take a second to break down what we added.

These methods are a requirement of the `WorkOrderSerializerInterface`. This interface describes how your data
translates to Field Nation data, and is a requirement of the SDK for creating work orders.
Each method is documented with what it does, and what the return type should be. For more information about
the types see the [interfaces](#interfaces) section.

There are a number of methods that require you to map your data to a type that is provided by the SDK.
Let's use `getPayInfo` as an example. Field Nation requires a specific schema for describing the pay info for a work order.
Because we don't know how _you_ pay technicians, we provide an interface, `PayInfoInterface`, for translating your
pay structure into a pay structure that we understand. The `PayInfoInterface` acts as container for the potential pay
types -- `FixedPayInterface`, `RatePayInterface`, and `BlendedPayInterface`. Each of these pay
interfaces also has a concrete class provided with the SDK (`FixedPay`, `RatePay`, `BlendedPay`).
You can use the classes that we've implemented to translate your pay structure into a Field Nation pay structure, or you 
could create your own concrete classes that implement the provided interfaces.

Now that we understand how our business objects translate to Field Nation business objects we can create a work order.
```php
<?php
$fnCompanyId = $_ENV['FIELD_NATION_COMPANY_ID'];
$fnApiKey = $_ENV['FIELD_NATION_API_KEY'];
$fnEffectiveUser = $_ENV['FIELD_NATION_EFFECTIVE_USER'];
$credentials = new \FieldNation\LoginCredentials($fnCompanyId, $fnApiKey, $fnEffectiveUser);
$fn = new \FieldNation\SDK($credentials);

$myTicket = new MyBusinessTicket();
$myTicket->setId(uniqid());
$myTicket->setTitle('Fix something at this place');
$myTicket->setDescription('Something went wrong. Fix it.');
$myTicket->setStartDateTime(new \DateTime());

// Returns a \FieldNation\WorkOrderInterface object
$fnWorkOrder = $fn->createWorkOrder($myTicket);
$myTicket->setFieldNationId($fnWorkOrder->getId());
````

### Work Order Actions and Metadata
Updating a work order is similar to creating a work order, but there are granular 
actions that you can make on a work order instance.

There are 2 ways of getting a Field Nation work order object.
1) If you just created one through the SDK::createWorkOrder method
2) If you called the SDK::getExistingWorkOrder method.
```php
<?php

// Just created a work order
$fnCompanyId = $_ENV['FIELD_NATION_COMPANY_ID'];
$fnApiKey = $_ENV['FIELD_NATION_API_KEY'];
$fnEffectiveUser = $_ENV['FIELD_NATION_EFFECTIVE_USER'];
$credentials = new \FieldNation\LoginCredentials($fnCompanyId, $fnApiKey, $fnEffectiveUser);
$fn = new \FieldNation\SDK($credentials);

$myTicket = new MyBusinessTicket();
$myTicket->setId(uniqid());
$myTicket->setTitle('Fix something at this place');
$myTicket->setDescription('Something went wrong. Fix it.');
$myTicket->setStartDateTime(new \DateTime());

// Returns a \FieldNation\WorkOrderInterface object
$fnWorkOrder = $fn->createWorkOrder($myTicket);
$myTicket->setFieldNationId($fnWorkOrder->getId());

// Fetching a work order after it was created
$ticket = $db->getTicket(1234); // pseudo code for fetching your ticket
$fnWorkOrder = $fn->getExistingWorkOrder($ticket->fnId);
```

Now that you have a Field Nation work order instance you can execute actions or get metadata about it.

#### Publish
Publish your work order on Field Nation
```php
/**
 * @returns ResultInterface
 */
$result = $fnWorkOrder->publish();
```

#### Route to Provider
Route your work order to a Provider. 
When creating a Provider object you need to set the Provider ID so it will be properly routed.
```php
/**
 * Create a provider object to route to
 */
$provider = new \FieldNation\Technician();
$provider->setId('1');

/**
 * @returns ResultInterface
 */
$result = $fnWorkOrder->routeTo($provider);
```

#### Route to Group
Route your work order to a Group.
When creating a Group object you need to set the Group ID so it will be properly routed.
```php
/**
 * Create a group to route to
 */
$group = new \FieldNation\Group();
$group->setId('100');

/**
 * @returns ResultInterface
 */
$result = $fnWorkOrder->routeTo($group);
```

#### Approve
Approve your work order.
```php
/**
 * @returns ResultInterface
 */
$result = $fnWorkOrder->approve();
```

#### Cancel
Sometimes you need to cancel your work order and start over.
```php
/**
 * @returns ResultInterface
 */
$result = $fnWorkOrder->cancel();
```

#### Attach Documents
Attach a document to your work order.
```php
/**
 * Create your document.
 */
 $document = new \FieldNation\Document();
 $document->setTitle('Instructions');
 $document->setType('application/pdf');
 $document->setUpdateTime(new \DateTime('now', new \DateTimeZone('UTC')));

/**
 * @returns ResultInterface
 */
$result = $fnWorkOrder->attach($document);
```

#### Detach Documents
Remove a document from your work order.
```php
/**
 * Create the document object
 */
$document = new \FieldNation\Document();
$document->setTitle('Instructions');

/**
 * @returns ResultInterface
 */
$result = $fnWorkOrder->detach($document);
```

#### Add a Custom Field
Your work orders are yours. Make them yours by adding a custom field.
```php
/**
 * One of your custom fields
 */
$field = new \FieldNation\CustomField();
$field->setName('My Business Ticket ID');

/**
 * @returns ResultInterface
 */
$result = $fnWorkOrder->addAdditionalField($field);
```

#### Add a Label
Add labels to your work order.
```php
/**
 * Create a label
 */
$label = new \FieldNation\Label();
$label->setName('New Work');
$label->setHideFromTech(true);

/**
 * @returns ResultInterface
 */
$result = $fnWorkOrder->addLabel($label);
```

#### Remove a Label
Remove a label from your work order.
```php
/**
 * Create a label
 */
$label = new \FieldNation\Label();
$label->setName('New Work');

/**
 * @returns ResultInterface
 */
$result = $fnWorkOrder->removeLabel($label);
```

#### Resolving a Closeout Requirement
Mark a closeout requirement as resolved.
```php
/**
 * Closeout Requirement
 */
$requirement = new \FieldNation\CloseoutRequirement();
$requirement->setName('Provider upload picture');

/**
 * @returns ResultInterface
 */
$result = $fnWorkOrder->resolveCloseoutRequirement($requirement);
```

#### Add a Shipment
Add a shipment for Field Nation to track to your work order.
```php
/**
 * Shipment
 */
$shipment = new \FieldNation\Shipment();
$shipment->setVendor('USPS');
$shipment->setTrackingId('my-tracking-number');

/**
 * @returns ResultInterface
 */
$result = $fnWorkOrder->addShipment($shipment);
```

#### Delete a Shipment
If a shipment no longer needs to be tracked delete it from your work order.
```php
// If you don't have the Field Nation shipment id, you can get it with your tracking number
$result = $sdk->getShippingIdFrom('my-tracking-number');
$shipment = new \FieldNation\Shipment();
$shipment->setId($result->getShipmentId());

/**
 * @returns ResultInterface
 */
$result = $fnWorkOrder->deleteShipment($shipment);
```

#### Update Schedule
Things change -- update the schedule for your work order.
```php
/**
 * Create a TimRange object
 */
$schedule = new TimeRange();
$schedule->setTimeBegin(new \DateTime('now'));
$schedule->setTimeEnd(new \DateTime('now'));

/**
 * @returns ResultInterface
 */
$result = $fnWorkOrder->updateSchedule($schedule);
```

#### Get the Entire Work Order
Occasionally it makes sense to get the entire work order. Here's how!

If you need something specific you should be calling that getter directly. This action is expensive so use it when
you really need it.
```php
/**
 * @returns WorkOrderInterface
 */
$fnWorkOrder = $fnWorkOrder->get(); // get all metadata and reassign the existing variable
```

#### Get the Status
Get the status of your work order
```php
/**
 * @returns string from \FieldNation\WorkOrderStatuses
 */
$status = $fnWorkOrder->getStatus();
```

#### Get the Assigned Provider
Get the information about the Provider that is assigned to your work order.
```php
/**
 * @returns \FieldNation\TechnicianInterface
 */
$provider = $fnWorkOrder->getAssignedProvider();
```

#### Get Progress
Get the progress of your work order.
```php
/**
 * @returns \FieldNation\ProgressInterface
 */
$progress = $fnWorkOrder->getProgress();
```

#### Get Payment
Get the payment information about your work order.
```php
/**
 * @returns \FieldNation\PaymentInterface
 */
$payment = $fnWorkOrder->getPayment();
```

#### Get Messages
Get the messages on your work order
```php
/**
 * @returns \FieldNation\MessageInterface[]
 */
$messages = $fnWorkOrder->getMessages();
```

#### Get Attached Documents
Get the attached documents on your work order.
```php
/**
 * @returns from \FieldNation\Document[]
 */
$documents = $fnWorkOrder->getAttachedDocuments();
```

#### Get Shipments
Get the tracked shipments for your work order.
```php
/**
 * @returns \FieldNation\Shipment[]
 */
$shipments = $fnWorkOrder->getShipments();
```

### Get Your Work Orders
Sometimes you need to get all of your work orders. Here's how!
```php
/**
 * Optionally you can filter your query by the status of the work order.
 * If the status is NULL we'll return all work orders.
 * You can get statuses from the \FieldNation\WorkOrderStatuses class
 */
$status = \FieldNation\WorkOrderStatuses::PUBLISHED

/**
 * @returns \FieldNation\WorkOrderInterface[]
 */
$workOrders = $sdk->getWorkOrders($status);
```

### Get Your Projects
Use to get all of the projects for your company.
```php
/**
 * @returns \FieldNation\ProjectInterface[]
 */
$projects = $sdk->getProjects();
```

### Get Your Documents
Get all of the documents for your company.
```php
/**
 * @returns \FieldNation\DocumentInterface[]
 */
$documents = $sdk->getDocuments();
```

### Convert a Tracking Number to a Shipping ID
If you have a tracking number for a shipment you created,
but didn't save the Field Nation shipping ID you can get it here.
```php
/**
 * @returns string
 */
$shippingId = $sdk->getShippingIdFrom('my-tracking-number');
```

### Using Your Classes

You may be wondering if you _have_ to use our PHP classes. The good news is that you don't! We implement all of our own
interfaces with plain ol' php objects as a set of defaults, but if your classes implement our interfaces you can
configure the SDK to use your classes. The only hard rule we have is that your class _must_ implement the interface
for the type you're trying to inject. If your class doesn't implement the interface we _will_ throw a `TypeError`.

Example replacing our WorkOrder with your class that implements our WorkOrderInterface.

```php
use \FieldNation\SDK;
use \FieldNation\ClassMapFactoryInterface;

SDK::configure(function (ClassMapFactoryInterface $classMap) {
    $classMap->setWorkOrder(\MyBusinessNamespace\MyClass::class);
});
```

Here is a list of all of the classes that are considered injectable.

```php
// Default configuration
SDK::configure(function (ClassMapFactoryInterface $classMap) {
    $classMap->setAdditionalExpense(\FieldNation\AdditionalExpense::class);
    $classMap->setAdditionalField(\FieldNation\AdditionalField::class);
    $classMap->setBlendedPay(\FieldNation\BlendedPay::class);
    $classMap->setCheckInOut(\FieldNation\CheckInOut::class);
    $classMap->setCloseoutRequirement(\FieldNation\CloseoutRequirement::class);
    $classMap->setCustomField(\FieldNation\CustomField::class);
    $classMap->setDocument(\FieldNation\Document::class);
    $classMap->setFixedPay(\FieldNation\FixedPay::class);
    $classMap->setGroup(\FieldNation\Group::class);
    $classMap->setHistory(\FieldNation\History::class);
    $classMap->setLabel(\FieldNation\Label::class);
    $classMap->setMessage(\FieldNation\Message::class);
    $classMap->setPayInfo(\FieldNation\PayInfo::class);
    $classMap->setPaymentDeduction(\FieldNation\PaymentDeduction::class);
    $classMap->setPayment(\FieldNation\Payment::class);
    $classMap->setProblem(\FieldNation\Problem::class);
    $classMap->setProgress(\FieldNation\Progress::class);
    $classMap->setProject(\FieldNation\Project::class);
    $classMap->setRatePay(\FieldNation\RatePay::class);
    $classMap->setServiceDescription(\FieldNation\ServiceDescription::class);
    $classMap->setServiceLocation(\FieldNation\ServiceLocation::class);
    $classMap->setShipmentHistory(\FieldNation\ShipmentHistory::class);
    $classMap->setShipment(\FieldNation\Shipment::class);
    $classMap->setTechnician(\FieldNation\Technician::class);
    $classMap->setTemplate(\FieldNation\Template::class);
    $classMap->setTimeRange(\FieldNation\TimeRange::class);
    $classMap->setWorkLog(\FieldNation\WorkLog::class);
    $classMap->setWorkOrder(\FieldNation\WorkOrder::class);
});
```

## Contributing

### Tests
All merge requests require tests passing tests. Merge requests will not be approved if the tests do not pass, and if there are no new tests for the changes.

```sh
$ composer test
```

### Coding Standards
We follow the [PSR-2](http://www.php-fig.org/psr/psr-2) coding style. We will lint the code and merge requests will not be approved if they do not pass linting. You can lint using PHP_CodeSniffer.

```sh
$ composer lint:check
```

If you have lint errors or warnings you can try to auto clean them with `composer lint:fix`. If the errors/warnings can't be
fixed on their own you will have to manually fix them. `composer lint:check` should always exit with a 0.

## Changelog
Please see the `CHANGELOG` or view the [releases](https://github.com/fieldnation/fieldnation-sdk-php/releases).

## License
Copyright 2017 [Field Nation](https://www.fieldnation.com)

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
