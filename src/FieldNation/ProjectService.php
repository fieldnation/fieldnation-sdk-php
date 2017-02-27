<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class ProjectService extends AbstractService
{
    /**
     * Get all of the projects for a company
     *
     * @return ProjectInterface[]
     */
    public function getAll()
    {
        $this->client->getProjects();
    }
}
