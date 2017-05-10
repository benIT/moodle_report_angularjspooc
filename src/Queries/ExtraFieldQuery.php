<?php
namespace ReportManager\Queries;

class ExtraFieldQuery extends AbstractQuery implements QueryInterface
{

    public function setSupportedFilters()
    {
        $this->supportedFilters = ['shortname'];
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
        $filters = $this->getFilters();
        $shortnameFilter = isset($filters['shortname']) ? sprintf('where shortname IN (\'%s\')', $filters['shortname']) : '';
        return '
           SELECT param1
            FROM mdl_user_info_field
            ' . $shortnameFilter;
    }
}