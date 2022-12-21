<?php

/** 
 * @var yii\web\View $this
 * @var $dataProvider yii\data\ActiveDataProvider
 */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap5\Modal;

$this->title = 'Images';  

?>

<?php Modal::begin(['id' => 'image-modal']); ?>

<div id="img-view" class="col-sm-10"></div>

<?php Modal::end(); ?>

<div class="site-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'filename',
			[
				'attribute' => 'updated_at',
				'format' => ['datetime'],
			],
            [
				'class' => 'yii\grid\ActionColumn',
				'header'=>'Preview',
				'template' => '{link}', 
				'buttons' => [
					'link' => function ($url, $model, $key) {						
						$img = Html::img(Yii::getAlias('@web').'/'.\Yii::$app->params['uploadDir'].$model->filename, ['width' => '100px']);
														
						return Html::a($img, $url, ['class'=>'modal-link', 'id'=>'preview-'.$key]);
					},
				],				
			],
        ],
    ]); 

$this->registerJs("$(function() {
   $('.modal-link').click(function(e) {
     e.preventDefault();

	 var imgSrc = $(this).children('img').attr('src');
	 
	 $('#img-view').html( '<img src=\"' + imgSrc + '\" />' );
	 $('#image-modal').modal('show');
   });
});");	
	
?>

</div>