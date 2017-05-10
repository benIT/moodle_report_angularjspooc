<?php
namespace ReportManager\Queries;

class CourseQuery extends AbstractQuery
{

    public function setSupportedFilters()
    {
        $this->supportedFilters = ['courseId'];
    }

    public function setSupportedGroupBy()
    {
        $this->supportedGroupBys = [];
    }


    public function getBuiledQuery()
    {

        $filters = $this->getFilters();
        $courseIdFilters = isset($filters['courseId']) ? sprintf('AND mdl_course.id IN (%s)', $filters['courseId']) : '';

        return '
SELECT
  mdl_course.fullname AS course,
  count(*)            AS "number",
  CASE
  WHEN (mdl_role.shortname IS NULL)
    THEN \'unknow\'
  ELSE
    mdl_role.shortname
  END as role
FROM mdl_course_completions
  LEFT JOIN mdl_user ON mdl_course_completions.userid = mdl_user.id
  LEFT JOIN mdl_course ON mdl_course.id = mdl_course_completions.course
  LEFT JOIN mdl_user_enrolments ON mdl_user.id = mdl_user_enrolments.userid
  LEFT JOIN mdl_enrol ON mdl_user_enrolments.enrolid = mdl_user_enrolments.id
  LEFT JOIN mdl_role ON mdl_enrol.roleid = mdl_role.id
  WHERE 
    mdl_course.id <> 1' .
            $courseIdFilters .
            'GROUP BY mdl_course.fullname, mdl_role.shortname
ORDER BY mdl_course.fullname;
';
    }
}