<?php
App::import('Model', 'RubricsCriteria');
App::import('Controller', 'RubricsCriterias');

class RubricsCriteriaTestCase extends CakeTestCase
{
    public $name = 'RubricsCriteria';
    public $fixtures = array(
        'app.course', 'app.role', 'app.user', 'app.group',
        'app.roles_user', 'app.event', 'app.event_template_type',
        'app.group_event', 'app.evaluation_submission',
        'app.survey_group_set', 'app.survey_group', 'app.survey',
        'app.survey_group_member', 'app.question',
        'app.response', 'app.survey_question', 'app.user_course',
        'app.user_enrol', 'app.groups_member', 'app.rubric', 'app.rubrics_lom',
        'app.rubrics_criteria', 'app.rubrics_criteria_comment',
        'app.faculty', 'app.user_faculty', 'app.department', 
        'app.course_department', 'app.sys_parameter', 'app.user_tutor'
    );
    public $RubricsCriteria = null;

    function startCase()
    {
        $this->RubricsCriteria = ClassRegistry::init('RubricsCriteria');
    }

    function endCase()
    {
    }

    function startTest($method)
    {
    }

    function endTest($method)
    {
    }

    function testRubricsCriteriaInstance()
    {
        $this->assertTrue(is_a($this->RubricsCriteria, 'RubricsCriteria'));
    }

    function testGetCriteria()
    {
        // Set up test data
        $criteria1 = $this->RubricsCriteria->getCriteria(4);
        // Compare result to fixture data
        $this->assertTrue(!empty($criteria1));
        $this->assertNotNull($criteria1);
        $this->assertEqual($criteria1[0]['RubricsCriteria']['criteria'], 'CRITERIA 1');
        $this->assertEqual($criteria1[1]['RubricsCriteria']['criteria'], 'CRITERIA 2');

    }
}
