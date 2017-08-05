<?php
/* @var $this MemberController */
/* @var $data Member */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->email), array('view', 'id'=>$data->email)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->created_datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vip_start')); ?>:</b>
	<?php echo CHtml::encode($data->vip_start); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vip_end')); ?>:</b>
	<?php echo CHtml::encode($data->vip_end); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vip_status')); ?>:</b>
	<?php echo CHtml::encode($data->vip_status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('point')); ?>:</b>
	<?php echo CHtml::encode($data->point); ?>
	<br />

	*/ ?>

</div>