<?php
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require __DIR__ . '/vendor/autoload.php';
use ReportManager\ReportManager;
use ReportManager\Formater\JsonFormater;

global $DB;
$context = context_system::instance();
require_capability('report/angularjspooc:run', $context);
$query = filter_input(INPUT_GET, "query", FILTER_SANITIZE_STRING);
$filters = [];
$groupBys = [];
//convention: filters starts by 'filter_' and groupby starts by 'groupby_'
//https://192.168.33.10/report/angularjspooc/ajax.php?query=CourseQuery&filter_courseId=7&groupBy_toto=true
foreach ($_GET as $key => $value) {
    if (strpos($key, 'filter_') !== false) {
        $filters[substr($key, 7)] = $value;
    }
    if (strpos($key, 'groupBy_') !== false) {
        $groupBys[substr($key, 8)] = $value;
    }
}
header('Content-Type: application/json');
$queryClass = 'ReportManager\Queries\\' . $query;
if (!class_exists($queryClass)) {
    throw new \Exception(sprintf('%s class not found', $queryClass));
}
$reportManager = new ReportManager();
$reportManager->setDb($DB);
$reportManager->setFormater(new JsonFormater());
$query = new $queryClass();
if($filters){
    $query->setFilters($filters);
}
if($groupBys){
    $query->setgroupBys($groupBys);
}

$reportManager->setQuery($query);
$reportManager->query();
$data = $reportManager->format();
echo json_encode($data);