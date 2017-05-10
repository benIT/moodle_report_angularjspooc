<?php

namespace ReportManager\Tests;


use ReportManager\Formater\JsonFormater;
use ReportManager\Queries\ExtraFieldQuery;
use ReportManager\ReportManager;
use ReportManager\Queries\CourseQuery;

class CourseQueryTest extends \PHPUnit_Framework_TestCase
{
    public static $db;

    public static function setUpBeforeClass()
    {
        define('CLI_SCRIPT', true);;
        require_once(__DIR__ . '/../../../../../config.php');
        global $DB;
        self::$db = $DB;
    }

    public function testQueryWithoutFilterNorGroupBy()
    {
        $reportManager = new ReportManager();
        $reportManager->setFormater(new JsonFormater());
        $reportManager->setDb(self::$db);
        $courseQuery = new CourseQuery();

        $courseQuery->setFilters([]);
        $courseQuery->setGroupBys([]);
        $reportManager->setQuery($courseQuery);
        $reportManager->query();
        $this->assertNotEmpty($reportManager->format());
    }

    /**
     * @expectedException Exception
     */
    public function testQueryWithWrongFilter()
    {
        $reportManager = new ReportManager();
        $reportManager->setFormater(new JsonFormater());
        $reportManager->setDb(self::$db);
        $courseQuery = new CourseQuery();
        $courseQuery->setFilters(['wrong']);
        $courseQuery->setGroupBys(['wrong']);
        $reportManager->setQuery($courseQuery);
        $reportManager->query();
    }

    public function testCourseQueryWithRightFilter()
    {
        $reportManager = new ReportManager();
        $reportManager->setFormater(new JsonFormater());
        $reportManager->setDb(self::$db);
        $courseQuery = new CourseQuery();
        $courseQuery->setFilters(['courseId'=>7]);
        $reportManager->setQuery($courseQuery);
        $reportManager->query();

    }


    public function testCourseQueryWithRightFilterA()
    {
        $reportManager = new ReportManager();
        $reportManager->setFormater(new JsonFormater());
        $reportManager->setDb(self::$db);
        $courseQuery = new ExtraFieldQuery();
        $courseQuery->setFilters([]);
        $reportManager->setQuery($courseQuery);
        $reportManager->query();
        $this->assertNotEmpty($reportManager->format());
        var_dump($reportManager->format());

    }

}