<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$label= $this->mim;
$label=mb_strtoupper(mb_substr($label,0,1)).mb_substr($label,1);

echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	Yii::t('yupe','Управление'),
);\n";
?>
$this-> pageTitle ="<?php echo $label ?> - "."Yii::t('yupe','управление')";
$this->menu=array(
array('icon'=> 'list-alt white', 'label' => Yii::t('yupe','Управление <?php echo $this->mtvor;?>'),'url'=>array('/<?php echo $this->controller; ?>/index')),
array('icon'=> 'file','label' => Yii::t('yupe','Добавить <?php echo $this->vin;?>'), 'url' => array('/<?php echo $this->controller; ?>/create')),
);
<?php echo  "?>"; ?>

<div class="page-header">
    <h1><?php echo "<?php echo Yii::t('yupe','$label');?>"; ?>
    <small><?php echo "<?php echo Yii::t('yupe','управление');?>"?></small>
    </h1>
</div>
<button class="btn btn-small dropdown-toggle"
        data-toggle="collapse"
        data-target="#search-toggle" >
    <?php echo CHtml::link(Yii::t('yupe','Поиск ').$this->mrod, '#', array('class' => 'search-button'));?>
    <span class="caret"></span>
</button>

<div id="search-toggle" class="collapse out">
<?php echo  "<?php "; ?>
Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('<?php echo  $this->class2id($this->modelClass); ?>-grid', {
data: $(this).serialize()
});
return false;
});
");
<?php echo  "    \$this->renderPartial('_search',array(
	'model'=>\$model,
));
?>\n"; ?>
</div>

<p><?php echo "<?php echo Yii::t('yupe','В данном разделе представлены средства управления');?>";?> <?php echo "<?php echo Yii::t('yupe','$this->mtvor');?>"; ?>.
</p>


<?php echo  "<?php
"; ?>
$dp = $model->search();
//$dp-> sort-> defaultOrder = "";
$this->widget('bootstrap.widgets.BootGridView',array(
'id'=>'<?php echo  $this->class2id($this->modelClass); ?>-grid',
'type'=>'condensed ',
'pager'=>array('class'=>'bootstrap.widgets.BootPager', 	'prevPageLabel'=>"←",'nextPageLabel'=>"→"),
'dataProvider'=>$dp,
'filter'=>$model,
'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
    if(++$count==7)
        echo "\t\t/*\n";
    echo "\t\t'".$column->name."',\n";
}
if($count>=7)
    echo "\t\t*/\n";
?>
array(
'class'=>'bootstrap.widgets.BootButtonColumn',
),
),
)); ?>
