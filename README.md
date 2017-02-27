![Field Nation Logo](images/logo.png)
# Field Nation PHP SDK
* [Build Status](#build-status)
* [Installation](#installation)
    * [Installation with Composer](#installation-with-composer)
* [Usage](#usage)
    * [Authentication](#authentication)
    * [Create a Work Order](#create-a-work-order)
    * [Update a Work Order](#update-a-work-order)
* [Interfaces](#interfaces)
* [Contributing](#contributing)
    * [Tests](#tests)
    * [Coding Standards](#coding-standards)
* [Changelog](#changelog)
* [License](#license)
    
## Build Status

## Installation

### Installation with Composer
Require the `fieldnation/fieldnation-sdk` package in your project.
```shell
$ composer require fieldnation/fieldnation-sdk
```

## Usage
The key concept to successfully integrating with Field Nation is describing how your business objects
become Field Nation objects,. We provide interfaces for describing how your data can be
created on Field Nation.

### Authentication
To use the SDK you need to generate an API key for your company.
You can create an API key at `https://app.fieldnation.com/api`. Once you have a key you can create a connection.
```php
<?php
$fnCompanyId = $_ENV['FIELD_NATION_COMPANY_ID'];
$fnApiKey = $_ENV['FIELD_NATION_API_KEY'];
$fnEffectiveUser = $_ENV['FIELD_NATION_EFFECTIVE_USER'];
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

### Update a Work Order
Updating a work order is similar to creating a work order. There are granular actions that you can take on a work order.

There are 2 ways of getting a Field Nation work order object. 1) If you just created one through the SDK::createWorkOrder method
and 2) If you called the SDK::getExistingWorkOrder method.
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

Now that you have a Field Nation work order there are a lot of actions you can run on it.
* get                    -- Get the entire Field Nation work order
* getStatus              -- Get the status of a work order
* getAssignedProvider    -- Get the assigned provider of a work order
* getProgress            -- Get the progress of a work order
* getPayment             -- Get the work order approval cost
* getMessages            -- Get all of the messages posted to a work order
* getAttachedDocuments   -- Get all of the attached documents for a work order
* getShipments           -- Get all of the shipments tracked by a work order
* publish                -- Publish the work order on Field Nation
* routeTo                -- Route the work order to either a Provider or a Group
* approve                -- Approve the work order
* cancel                 -- Cancel the work order and start again
* attach                 -- Attach an existing document to the work order
* detach                 -- Detach a document from the work order
* addMessage             -- Add a message to the work order
* addAdditionalFields    -- Add a custom field to the work order
* addLabel               -- Add a label to the work order
* removeLabel            -- Remove a label from the work order
* satisfyCloseoutRequest -- Mark a close out request as resolved
* addShipment            -- Add a shipment to track to the work order
* deleteShipment         -- Remove a tracked shipment from the work order
* updateSchedule         -- Update the work order schedule

Most of these methods that provide actions (non-getters) require that you call the method with an interface describing your data.
The interface implementation for these required objects is no different than the `WorkOrderSerializerInterface` -- they are just more specific.
To see what is required for a specific method, please see the `WorkOrderInterface` documentation.

## Interfaces
All of the SDK types are described by interfaces. You can be confident that if you use classes you created
that implement these interfaces that they will _always_ work with the SDK unless otherwise noted in the `CHANGELOG`.
These interfaces are well documented in the source code.

* `AdditionalExpenseInterface`
* `AdditionalFieldInterface`
* `BlendedPayInterface`
* `CheckInOutInterface`
* `ClientFactoryInterface`
* `ClientInterface`
* `CustomFieldInterface`
* `DescribableInterface`
* `DocumentInterface`
* `FixedPayInterface`
* `GroupInterface`
* `HistoryInterface`
* `IdentifiableInterface`
* `LabelInterface`
* `MessageInterface`
* `PayIntoInterface`
* `PaymentDeductionInterface`
* `PaymentInterface`
* `ProblemInterface`
* `ProgressInterface`
* `ProjectInterface`
* `RatePayInterface`
* `RecipientInterface`
* `ResultInterface`
* `SDKCredentialsInterface`
* `SDKInterface`
* `ServiceDescriptionInterface`
* `ServiceLocationInterface`
* `ShipmentHistoryInterface`
* `ShipmentInterface`
* `TechnicianInterface`
* `TechUploadInterface`
* `TemplateInterface`
* `TimeRangeInterface`
* `TrackingToShipmentResultInterface`
* `UserInterface`
* `WorkLogInterface`
* `WorkOrderInterface`
* `WorkOrderSerializerInterface`

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
