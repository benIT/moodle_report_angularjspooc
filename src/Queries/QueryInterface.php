<?php
namespace ReportManager\Queries;

interface QueryInterface
{
    public function getBuiledQuery();

    public function setSupportedFilters();

    public function setSupportedGroupBy();

}