<?php
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
global $DB;
$context = context_system::instance();
$context = context_system::instance();
require_login();
require_capability('report/angularjspooc:run', $context);
$data = new stdClass();
$PAGE->set_context($context);
$PAGE->set_pagelayout("print");
$title = get_string('pluginname', 'report_angularjspooc');
$PAGE->requires->css('/report/angularjspooc/node_modules/bootstrap/dist/css/bootstrap.css', true); //required for ng-table pagination ?
$PAGE->requires->css('/report/angularjspooc/node_modules/isteven-angular-multiselect/isteven-multi-select.css', true);
$PAGE->requires->css('/report/angularjspooc/angular/vendors/ng-table/ng-table.min.css', true); //todo npm !!
$PAGE->requires->js('/report/angularjspooc/node_modules/jquery/dist/jquery.min.js', true);
$PAGE->requires->js('/report/angularjspooc/node_modules/angular/angular.min.js', true);
$PAGE->requires->js('/report/angularjspooc/bower_components/ng-csv/build/ng-csv.min.js', true);
$PAGE->requires->js('/report/angularjspooc/bower_components/angular-sanitize/angular-sanitize.min.js', true);
$PAGE->requires->js('/report/angularjspooc/node_modules/bootstrap/dist/js/bootstrap.min.js', true);
$PAGE->requires->js('/report/angularjspooc/node_modules/angular-route/angular-route.min.js', true);
$PAGE->requires->js('/report/angularjspooc/node_modules/isteven-angular-multiselect/isteven-multi-select.js', true);
$PAGE->requires->js('/report/angularjspooc/node_modules/chart.js/dist/Chart.min.js', true);
$PAGE->requires->js('/report/angularjspooc/node_modules/angular-chart.js/dist/angular-chart.min.js', true);
$PAGE->requires->js('/report/angularjspooc/angular/vendors/ng-table/ng-table.min.js', true);
$PAGE->requires->js('/report/angularjspooc/dist/assets/js/global.min.js', true); //ANGULAR APP CODE
$url = new moodle_url("/report/angularjspooc/index.php");
$PAGE->set_url($url);
$PAGE->set_title($title);
$output = $PAGE->get_renderer('report_angularjspooc');
echo $output->header();
$renderable = new reportindex_page($data);
echo $output->render($renderable);
echo $output->footer();