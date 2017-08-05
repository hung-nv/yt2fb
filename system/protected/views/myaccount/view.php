<?php
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs = array(
    'User' => array('admin'),
    $model->username,
);
?>

<h1>View Account #<?php echo $model->username; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'username',
        array(
            'name' => 'password',
            'value' => '******'
        ),
        array(
            'name' => 'module',
            'value' => $model->getModuleListNames()
        ),
        array(
            'name' => 'status',
            'value' => $model->status == 1 ? "Yes" : "No"
        ),
    ),
));
?>
