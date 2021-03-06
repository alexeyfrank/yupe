<?php
$this->breadcrumbs=array(
	'категории'=>array('index'),
	Yii::t('yupe','Управление'),
);
$this-> pageTitle ="категории - "."Yii::t('yupe','управление')";
$this->menu=array(
array('icon'=> 'list-alt white', 'label' => Yii::t('yupe','Управление категориями'),'url'=>array('/category/category/index')),
array('icon'=> 'file','label' => Yii::t('yupe','Добавить категорию'), 'url' => array('/category/category/create')),
);
?>
<div class="page-header">
    <h1><?php echo Yii::t('yupe','категории');?>    <small><?php echo Yii::t('yupe','управление');?></small>
    </h1>
</div>
<button class="btn btn-small dropdown-toggle"
        data-toggle="collapse"
        data-target="#search-toggle" >
    <a class="search-button" href="#">Поиск категорий</a>    <span class="caret"></span>
</button>

<div id="search-toggle" class="collapse out">
<?php Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('category-grid', {
data: $(this).serialize()
});
return false;
});
");
    $this->renderPartial('_search',array(
	'model'=>$model,
));
?>
</div>

<p><?php echo Yii::t('yupe','В данном разделе представлены средства управления');?> <?php echo Yii::t('yupe','категориями');?>.
</p>


<?php
$dp = $model->search();
//$dp-> sort-> defaultOrder = "";
$this->widget('bootstrap.widgets.BootGridView',array(
'id'=>'category-grid',
'type'=>'condensed ',
'pager'=>array('class'=>'bootstrap.widgets.BootPager', 	'prevPageLabel'=>"←",'nextPageLabel'=>"→"),
'dataProvider'=>$dp,
'filter'=>$model,
'columns'=>array(
		'id',
		'parent_id',
		'name',
		'description',
		'alias',
		'status',
array(
'class'=>'bootstrap.widgets.BootButtonColumn',
),
),
)); ?>
