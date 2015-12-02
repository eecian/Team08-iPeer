<div id='StudentHome'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<?php
function getUpcomingTableArray($html, $events) {
    $ret = array();
    foreach ($events as $event) {
        $tmp = array();
        if (isset($event['Group']['group_name'])) {
            $tmp[] = $html->link($event['Event']['title'],
                '/evaluations/makeEvaluation/'.$event['Event']['id'].'/'.
                $event['Group']['id']);
            $tmp[] = $event['Group']['group_name'];
        }
        else {
            $tmp[] = $html->link($event['Event']['title'],
                '/evaluations/makeEvaluation/'.$event['Event']['id']);
        }
        $tmp[] = $event['Course']['course'];
        $tmp[] = Toolkit::formatDate($event['Event']['due_date']);

        $due = $event['Event']['due_in'];
        if ($event['late']) {
            $penalty = isset($event['percent_penalty']) ?
                ', ' . $event['percent_penalty'] . '&#37; penalty' : '';
            $tmp[] = "<span class='red'>$due</span>$penalty";
        }
        else {
            $tmp[] = $due;
        }

        $ret[] = $tmp;
    }
    return $ret;
}

$evalUpcoming = getUpcomingTableArray($html, $evals['upcoming']);
$evalRevupcoming = getUpcomingTableArray($html, $evals['revupcoming']);
$surveyUpcoming = getUpcomingTableArray($html, $surveys['upcoming']);

function getNonUpcomingTableArray($html, $events) {
    $ret = array();
    foreach ($events as $event) {
        $tmp = array();
        if (isset($event['Event']['is_result_released']) &&
            $event['Event']['is_result_released']
        ) { // we're in the result release period, so link to the results
            $tmp[] = $html->link($event['Event']['title'],
                '/evaluations/studentViewEvaluationResult/' .
                $event['Event']['id'] . '/' . $event['Group']['id']);
            $tmp[] = $event['Event']['result_release_date_end'];
        }
        else if ($event['Event']['event_template_type_id'] == 3) {
            // this is a survey, no release period, so link to the results
            $tmp[] = $html->link($event['Event']['title'],
                '/evaluations/studentViewEvaluationResult/' .
                $event['Event']['id']);
        }
        else {
            // we're not in the result release period, notify user when they can
            // view the results
            if ($event['Event']['is_released']) {
                // can let students edit their submissions
                if (isset($event['Group']['group_name'])) {
                    $tmp[] = $html->link($event['Event']['title'],
                        '/evaluations/makeEvaluation/'.$event['Event']['id'].
                        '/'. $event['Group']['id']);
                }
                else {
                    $tmp[] = $html->link($event['Event']['title'],
                        '/evaluations/makeEvaluation/'.$event['Event']['id']);
                }
            }
            else {
                $tmp[] = $event['Event']['title'];
            }
            $tmp[] = "<span class='orangered'>" .
                $event['Event']['result_release_date_begin'] . "</span>";
        }
        if (isset($event['Group']['group_name'])) {
            // NOTE: surveys don't have group names
            $tmp[] = $event['Group']['group_name'];
        }
        $tmp[] = $event['Course']['course'];
        $tmp[] = Toolkit::formatDate($event['Event']['due_date']);
        if (!empty($event['EvaluationSubmission'])) {
            // expired events have no submissions
            $tmp[] = $event['EvaluationSubmission']['date_submitted'];
        }
        $ret[] = $tmp;
    }
    return $ret;
}

$evalSubmitted = getNonUpcomingTableArray($html, $evals['submitted']);
$surveySubmitted = getNonUpcomingTableArray($html, $surveys['submitted']);
$evalExpired = getNonUpcomingTableArray($html, $evals['expired']);
// note that we have this section for completeness, but currently,
// surveys are removed once past the due date, so unless the student
// made a submission, it won't show up
$surveyExpired = getNonUpcomingTableArray($html, $surveys['expired']);

if ($numOverdue) {
    echo "<div class='eventSummary overdue'>$numOverdue Overdue Event(s)</div>";
}
if ($numDue) {
    echo "<div class='eventSummary pending'>$numDue Pending Event(s) Total</div>";
}
else {
    echo "<div class='eventSummary alldone'>No Event(s) Pending</div>";
}
?>


<h2>Peer Evaluations</h2>
<h3>Due</h3>
<table class='standardtable'>
    <thead>
    <tr>
       <th>Event</th>
       <th>Group</th>
       <th>Course</th>
       <th>Due Date</th>
       <th>Due In/<span class='red'>Late By</span></th>
      <button onclick="myFunction()">Sort by newest/oldest</button>
    </tr>
    </thead>
    <tbody>
    <?php
    echo $html->tableCells($evalUpcoming);
    ?>
    <?php if (empty($evalUpcoming)):?>
    <tr><td colspan="5" align="center"><b> No peer evaluations due at this time </b></td></tr>
    <?php endif; ?>
    </tbody>
    <script>
        function myFunction(){
            var table = document.getElementsByTagName('tbody');

            for (var i = 0; i < table.length; i++) {
                var rows = table[i].rows;
                for (var j = 0; j < rows.length; j++) {
                        rows[j].parentNode.insertBefore(rows[rows.length-1], rows[j]);
                }
            }

            }

        </script>
</table>

<h3>Submitted</h3>
<table class='standardtable'>
    <thead>
    <tr>
        <th>Event</th>
        <th>Result <span class='orangered'>Available</span>/End</th>
        <th>Group</th>
        <th>Course</th>
        <th>Due Date</th>
        <th>Date Submitted</th>
    </tr>
    </thead>
    <tbody>
<?php echo $html->tableCells($evalSubmitted); ?>
<?php if (empty($evalSubmitted)):?>
    <tr>
        <td colspan="6" align="center">No submitted evaluations available.</td>
    </tr>
<?php endif; ?>
</tbody>
</table>

<?php if (!empty($evalExpired)):?>
<h3>Expired With No Submission</h3>
<table class='standardtable'>
    <thead>
    <tr>
        <th>Event</th>
        <th>Result <span class='orangered'>Available</span>/End</th>
        <th>Group</th>
        <th>Course</th>
        <th>Due Date</th>
    </tr>
    </thead>
    <tbody>
<?php echo $html->tableCells($evalExpired); ?>
    </tbody>
</table>
<?php endif; ?>

<h2>Surveys</h2>
<h3>Due</h3>
<table class='standardtable'>
    <thead>
    <tr>
       <th>Event</th>
       <th>Course</th>
       <th>Due Date</th>
       <th>Due In/<span class='red'>Late By</span></th>
    </tr>
    </thead>
    <tbody>
    <?php
    echo $html->tableCells($surveyUpcoming);
    ?>
    <?php if (empty($surveyUpcoming)):?>
    <tr><td colspan="4" align="center"><b> No survey due at this time </b></td></tr>
    <?php endif; ?>
    </tbody>
</table>

<h3>Submitted</h3>
<table class='standardtable'>
    <thead>
    <tr>
        <th>Event</th>
        <th>Course</th>
        <th>Due Date</th>
        <th>Date Submitted</th>
    </tr>
    </thead>
    <tbody>
<?php echo $html->tableCells($surveySubmitted); ?>
<?php if (empty($surveySubmitted)):?>
    <tr>
        <td colspan="4" align="center">No submitted surveys available.</td>
    </tr>
<?php endif; ?>
   </tbody>
</table>

<?php if (!empty($surveyExpired)):?>
<h3>Expired With No Submission</h3>
<table class='standardtable'>
    <thead>
    <tr>
        <th>Event</th>
        <th>Course</th>
        <th>Due Date</th>
    </tr>
    </thead>
    <tbody>
<?php echo $html->tableCells($surveyExpired); ?>
</table>
<?php endif; ?>
</tbody>

</div>
