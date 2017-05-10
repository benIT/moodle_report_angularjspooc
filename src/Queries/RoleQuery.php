<?php
namespace ReportManager\Queries;

class RoleQuery extends AbstractQuery
{

    public function setSupportedFilters()
    {
        $this->supportedFilters = null;
    }

    public function setSupportedGroupBy()
    {
        $this->supportedGroupBys = null;
    }

    /**
     * @return string
     */
    public function getBuiledQuery()
    {
        return '
SELECT shortname
FROM mdl_role
;
';
    }
}