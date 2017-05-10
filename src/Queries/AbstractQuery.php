<?php
namespace ReportManager\Queries;


abstract class AbstractQuery implements QueryInterface
{
    protected $supportedFilters;
    protected $supportedGroupBys;
    private $filters;
    private $groupBys;

    /**
     * @return mixed
     */
    public function getFilters()
    {
        return $this->filters;
    }

    public function setFilters(array $filters)
    {
        foreach ($filters as $key => $value) {
            if (!in_array($key, $this->supportedFilters)) {
                throw new \Exception(sprintf('filter %s is not supported', $key));
            }
        }
        $this->filters = $filters;
    }

    /**
     * @return mixed
     */
    public function getGroupBys()
    {
        return $this->groupBys;
    }

    public function setGroupBys(array $groupbys)
    {
        foreach ($groupbys as $key => $value) {
            if (!in_array($key, $this->supportedGroupBys)) {
                throw new \Exception(sprintf('groupby %s is not supported', $key));
            }
        }
        $this->groupBys = $groupbys;
    }

    public function __construct()
    {
        $this->setSupportedFilters();
        $this->setSupportedGroupBy();
    }
}