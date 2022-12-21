<?php 

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<div class="site-contact">
    <div class="row">
        <h2>Загрузите до 5 изображений</h2>
	
		<div class="col-lg-5">
			<?= $form->field($model, 'file[]')->fileInput(['multiple' => true])->label('Image') ?>
			
			<div class="form-group">	
				 <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'image-submit-button']) ?>
			</div>
		</div>	
	</div>			
</div>	
	
<?php ActiveForm::end() ?>