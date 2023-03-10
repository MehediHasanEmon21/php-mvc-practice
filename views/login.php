<?php

/** @var $model \app\models\LoginForm */

use app\core\form\Form;

?>

<h1 class="mt-5">Login</h1>

<?php $form = Form::begin('', 'post') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password') ?>
    <button class="btn btn-success mt-5">Submit</button>
<?php Form::end() ?>