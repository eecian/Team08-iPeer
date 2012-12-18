<form name="frm" id="frm" method="POST" action="<?php echo $html->url(empty($event['Event']['id'])?'add':'edit') ?>">
<?php echo empty($event['Event']['id']) ? null : $this->Form->hidden('id'); ?>

<table class="standardtable">
    <tr><th colspan="2">Evaluation Event</th></tr>
    <tr>
        <th><?php __('Course')?></th>
        <td><?php echo $event['Course']['full_name']; ?>
        </td>
    </tr>
    <tr>
        <th><?php __('Event Title')?></th>
        <td><?php echo $event['Event']['title']; ?></td>
    </tr>
    <tr>
        <th><?php __('Description')?></th>
        <td><?php echo $event['Event']['description']; ?></td>
    </tr>
    <tr>
        <th valign="top"><?php __('Evaluation Format')?></th>
        <td>
            <?php echo $event['EventTemplateType']['type_name'];?>
        </td>
    </tr>
    <tr>
        <th valign="top"><?php __('Evaluation')?></th>
        <td>
            <?php echo $html->link($event[$modelName]['name'], '/'.strtolower(Inflector::pluralize($modelName)).'/view/'.$event[$modelName]['id']);?>
        </td>
    </tr>
    <tr>
        <th><?php __('Allow Self-Evaluation?')?></th>
        <td>
            <?php echo $event['Event']['self_eval']==1? 'Enable' : 'Disable'; ?>
        </td>
    </tr>
    <tr>
        <th><?php __('Require Student Comments?')?></th>
        <td><?php echo $event['Event']['com_req']==1? 'Yes' : 'No'; ?></td>
    </tr>
    <tr>
        <th><?php __('Due Date')?>&nbsp;</th>
        <td><?php echo Toolkit::formatDate($event['Event']['due_date']) ?></td>
    </tr>
    <tr>
        <th><?php __('Evaluation Release Date')?></th>
        <td id="release_date_begin">
            <table width="100%">
                <tr align="left">
                    <td width="10%"><?php __('FROM:')?></td>
                    <td width="90%">
                        <?php echo Toolkit::formatDate($event['Event']['release_date_begin']) ?>
                    </td>
                </tr>
                <tr>
                    <td width="10%"><?php __('TO:')?></td>
                    <td width="90%">
                        <?php echo Toolkit::formatDate($event['Event']['release_date_end']) ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <th><?php __('Result Release Date')?></th>
        <td id="result_release_date_begin">
            <table width="100%">
                <tr align="left">
                    <td width="10%"><?php __('FROM:')?></td>
                    <td width="90%">
                        <?php echo Toolkit::formatDate($event['Event']['result_release_date_begin']) ?>
                    </td>
                </tr>
                <tr>
                    <td width="10%"><?php __('TO:')?></td>
                    <td width="90%">
                        <?php echo Toolkit::formatDate($event['Event']['result_release_date_end']) ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <th><?php __('Late Penalty')?></th>
        <td>
            <?php
            if (!empty($event['Penalty'])) {
                foreach ($event['Penalty'] as $tmp) {
                    echo 'Deduct '.$tmp['percent_penalty'].'% if late by '.$tmp['days_late'].' day';
                    if (1 != $tmp['days_late']) {
                        echo 's';
                    }
                    echo '<br>';
                    $dayslate_count = $tmp['days_late'];
                }
            } else {
                echo 'No late penalties currently set';
            }
            ?>
        </td>
    </tr>
    <tr>
        <th valign="top"><?php __('Groups Assignment')?></th>
        <td>
        <?php
            $params = array('controller'=>'events', 'data'=>$event['Group'], 'event_id' => $event['Event']['id'], 'popup' => 'n');
            echo $this->element('events/event_groups_detail', $params);
        ?>
        </td>
    </tr>
</table>

<div style="text-align: center;">
    <?php echo $html->link(__('Edit this Event', true), '/events/edit/'.$event['Event']['id']); ?> |
    <?php echo $html->link(__('Back to Event Listing', true), '/events/index/'.$event['Event']['course_id']); ?>
</div>
</form>
