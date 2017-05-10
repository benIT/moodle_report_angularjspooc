<?php
namespace ReportManager\Queries;

class UserStateQuery extends AbstractQuery
{


    public function setSupportedFilters()
    {
        return null;
    }

    public function setSupportedGroupBy()
    {
        return null;
    }


    /**
     * @return string
     */
    public function getBuiledQuery()
    {
        return '
SELECT
  count(*) FILTER (WHERE deleted=1) as deleted,
  count(*) FILTER (WHERE suspended=1) as suspended,
  count(*) FILTER (WHERE suspended=0 AND suspended=0) as active
from mdl_user;
';
    }
}