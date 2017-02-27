<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class DocumentService extends AbstractService
{
    /**
     * Get all of the documents for a company
     *
     * @return DocumentInterface[]
     */
    public function getAll()
    {
        return $this->client->getDocuments();
    }
}