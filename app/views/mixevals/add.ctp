<div class="MixevalAdd">
<?php 
/* Unfortunately, if we want the nice responsive and user friendly question 
 * editing all on a single page, there's quite a bit of unwieldy complexity 
 * involved. The easier, more clean way, is how surveys implement question 
 * editing, involving multiple pages. However, since we want Mixeval to replace 
 * all the other evaluations eventually, it's probably best that we deal with 
 * some complexity in order to make it easy to use.
 *
 * Most of the complexity is hidden away in the mixeval element questions_editor
 */

/* Create the Form */
echo $form->create('Mixeval');
echo $html->tag('h3', _('Info'));
echo $form->input('name');
echo $form->input(
    'availability', 
    array(
        'type' => 'radio',
        'default' => 'private',
        'options' => array('public' => _('Public'), 'private' => _('Private'))
    )
);
echo $html->div("help-text", 
    _('Public lets you share this mixed evaluation with other instructors.'));
echo $this->Form->input('zero_mark');
echo $html->div("help-text", 
    _('Start marks from zero for all Likert questions.'));

// Question section
echo $html->tag('h3', _('Questions'));
$addQButton = $form->button(_('Add'), 
    array('type' => 'button', 'onclick' => "insertQ();"));
echo $form->input('MixevalQuestionType', array('after' => $addQButton));
echo $this->element('mixevals/questions_editor', 
    array('qTypes' => $mixevalQuestionTypes));

// Submit
echo $html->div('center', 
    $form->button(_('Back'), array('onclick' => 
        "javascript:(history.length > 1) ? history.back() : window.close();'")).
    $form->button(_('Save'))
);

echo $this->Form->end();
?>
</div>
