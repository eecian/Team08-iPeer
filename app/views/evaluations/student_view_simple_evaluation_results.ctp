<table width="100%"  border="0" cellpadding="8" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td>
	<?php echo empty($params['data']['Evaluation']['id']) ? null : $html->hidden('Evaluation/id'); ?>
	  <?php 
    $params = array('controller'=>'evaluations', 'event'=>$event, 'penalty' => $studentResult['penalty'], 'ratingPenalty' => $studentResult['avePenalty'], 'gradeReleaseStatus'=>$studentResult['gradeReleaseStatus'], 'aveScore'=>isset($studentResult['aveScore'])? $studentResult['aveScore']: 0, 'groupAve'=>isset($studentResult['groupAve'])? $studentResult['groupAve']: 0);
    echo $this->element('evaluations/student_view_event_info', $params);
    ?>

 			<table width="100%" border="0" align="center" cellpadding="4" cellspacing="2">
        <tr class="tableheader">
          <td width="10" height="32" align="center"><?php __('Comment&nbsp;(Randomly Ordered)')?></td>
        </tr>
				<?php $i = 0;
				if (isset($studentResult['comments'])) {
				foreach($studentResult['comments'] as $row): $evalMarkSimple = $row['EvaluationSimple']; ?>
    				<?php
          		  if (!empty($evalMarkSimple['eval_comment'])) {
    								echo '<tr class="tablecell2"><td width="60%">' . $evalMarkSimple['eval_comment'] . '</td></tr>' ;
                 } else {
        						echo '<tr class="tablecell2"><td>n/a</td></tr>';
    						 }
          			 ?>
			<?php endforeach;
			   }
			   else { ?>
			    <tr class="tablecell2" align="center">
          <td><?php echo __('Not Released.', true); ?>	</td>
				  </tr>
   	  <?php } ?>

			</table>


	</td>
  </tr>
</table>
