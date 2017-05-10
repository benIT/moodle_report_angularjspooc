<?php
namespace ReportManager;

use ReportManager\Formater\FormaterInterface;
use ReportManager\Queries\CourseQuery;
use ReportManager\Queries\QueryInterface;

class ReportManager
{
    /** @var  $query QueryInterface */
    private $query;

    /** @var  $formater FormaterInterface */
    private $formater;

    /** @var  $db \moodle_database */
    private $db;

    /** @var  $results \moodle_recordset */
    private $results;


    /**
     * @return mixed
     */
    public function format()
    {
        return $this->formater->format($this->results);
    }

    /**
     * perfoms query againt $this->db
     */
    public function query()
    {
        $this->results = $this->db->get_recordset_sql($this->getQuery()->getBuiledQuery());
    }

    /**
     * @return QueryInterface
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param QueryInterface $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }


    /**
     * @return \moodle_database
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param \moodle_database $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @return \moodle_recordset
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param \moodle_recordset $results
     */
    public function setResults($results)
    {
        $this->results = $results;
    }

    /**
     * @return FormaterInterface
     */
    public function getFormater()
    {
        return $this->formater;
    }

    /**
     * @param FormaterInterface $formater
     */
    public function setFormater($formater)
    {
        $this->formater = $formater;
    }

    public function test()
    {
        return 'test';
    }
}