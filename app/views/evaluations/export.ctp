<div id='exportEval'>
<h2><?php echo __('Instructions', true) ?></h2>
<ul>
    <li><?php echo __("Give the export file a name, which is default to today's date.", true)?></li>
    <li><?php echo __("Choose one of the three export formats.", true)?></li>
    <li><?php echo __("Please check at least one from each similarly coloured group.", true)?></li>
</ul>
<h2><?php echo __('Export', true) ?></h2>
<?php
echo $this->Form->create('ExportEval', array('url' => '/'.$this->params['url']['url']));
echo $this->Form->input('file_name', array(
    'name' => 'file_name', 'value' => isset($file_name) ? $file_name : '',
    'label' => __('Export Filename', true)
));
echo $this->Form->input('export_type', array(
    'name' => 'export_type', 'options' => $fileTypes,
    'label' => __('Export File Type', true)
));
echo "<div class='help-text' id='fileTypeHelp'></div>";
$evaluations = ($fromEvent) ? array($selectedEvent['Event']['id'] => $selectedEvent['Event']['title']) :
    Set::combine($events, '{n}.Event.id', '{n}.Event.title');
echo $this->Form->input('event_id', array(
    'name' => 'event_id', 'options' => $evaluations, 'label' => 'Event Name'
));
?>
<h3><?php echo __('Evaluation Information', true) ?></h3>
<?php
echo $this->Form->input('course_name', array(
    'type'=>'checkbox', 'name' => 'include[course]', 'checked' => true,
    'label' => __('Include Course Name', true).' <font color="red">*</font>'
));
echo $this->Form->input('event_name', array(
    'type' => 'checkbox', 'name' => 'include[eval_event_names]', 'checked' => true,
    'label' => __('Include Event Name', true).' <font color="red">*</font>'
));
echo $this->Form->input('eval_type', array(
    'type' => 'checkbox', 'name' => 'include[eval_event_type]', 'checked' => true,
    'label' => __('Include Evaluation Type', true)
));
?>
<h3><?php echo __('Group and Result', true) ?></h3>
<?php
echo $this->Form->input('group_name', array(
    'type' => 'checkbox', 'name' => 'include[group_names]', 'checked' => true,
    'label' => __('Include Group Names', true)
));
echo $this->Form->input('student_name', array(
    'type' => 'checkbox', 'name' => 'include[student_name]', 'checked' => true,
    'label' => __('Include Student Name', true).' <font color="green">*</font>'
));
echo $this->Form->input('student_id', array(
    'type' => 'checkbox', 'name' => 'include[student_id]', 'checked' => true,
    'label' => __('Include Student Id', true).' <font color="green">*</font>'
));
echo $this->Form->input('comments', array(
    'type' => 'checkbox', 'name' => 'include[comments]', 'checked' => true,
    'label' => __('Include Comments', true).' <font color="orange">*</font>'
));
echo $this->Form->input('grades', array(
    'type' => 'checkbox', 'name' => 'include[grade_tables]', 'checked' => true,
    'label' => __('Include Grades', true).' <font color="orange">*</font>'
));
echo $this->Form->input('final_marks', array(
    'type' => 'checkbox', 'name' => 'include[final_marks]', 'checked' => true,
    'label' => __('Include Final Marks', true)
));
echo $this->Form->submit(__('Export', true));
echo $this->Form->end();
?>
</div>
<script type="text/javascript">
exportTypeHelp();
function exportTypeHelp() {
    var selected = jQuery("#ExportEvalExportType option:selected").val();
    switch(selected) {
        case 'detailed':
            jQuery('#fileTypeHelp').html('Contains the detailed scores and comments.');
            break;
        case 'summary':
            jQuery('#fileTypeHelp').html('Only contains the total mark and average mark.');
            break;
        case 'pdf':
            jQuery('#fileTypeHelp').html('Formatted similarly to the evaluation results page.');
            break;
    };
}
jQuery().ready(function() {
    jQuery('#ExportEvalExportType').change(function(){
        exportTypeHelp();
    });
});
</script>