
<!DOCTYPE html>
<html>
<head>
    <title>
		Pharmacy
    </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">

</head>
<body>

<?php
echo $this->Html->css(['doctor/bootstrap.min','doctor/select2','pharmacy/bootstrap-multiselect','doctor/bootstrap-datetimepicker.min-date','doctor/bootstrap-datetimepicker.min','doctor/bootstrap-datetimepicker-standalone-date','doctor/style_doctor']);
echo $this->Html->script(['pharmacy/jquery3.2.1.min.js','pharmacy/bootstrap.min.js','pharmacy/jquery.select2.js','pharmacy/datatable.js']);
?>

    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</body>
</html>
