<h1 class="mt-5">Register</h1>

<?php
use app\core\form\Form;
?>

<?php $form = Form::begin('', 'post') ?>
    <div class="row">
        <div class="col">
            <?php echo $form->field($model, 'firstname') ?>
        </div>
        <div class="col">
            <?php echo $form->field($model, 'lastname') ?>
        </div>
    </div>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password') ?>
    <?php echo $form->field($model, 'confirmPassword') ?>
    <button class="btn btn-success mt-3">Submit</button>
<?php Form::end() ?>