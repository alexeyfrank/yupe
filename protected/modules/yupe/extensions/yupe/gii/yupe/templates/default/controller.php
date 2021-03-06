<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo  "<?php\n"; ?>

class <?php echo  $this->controllerClass; ?> extends <?php echo  $this->baseControllerClass."\n"; ?>
{
	/**
	 * Отображает <?php echo $this->vin;?> по указанному идентификатору
	 * @param integer $id Идинтификатор <?php echo $this->vin;?> для отображения
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Создает новую модель <?php echo $this->rod;?>.
	 * Если создание прошло успешно - перенаправляет на просмотр.
	 */
	public function actionCreate()
	{
		$model=new <?php echo  $this->modelClass; ?>;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['<?php echo  $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo  $this->modelClass; ?>'];

			if($model->save())
                        {
                            Yii::app()->user->setFlash(YFlashMessages::NOTICE_MESSAGE,Yii::t('yupe','Запись добавлена!'));

			    $this->redirect(array('view','id'=>$model-><?php echo  $this->tableSchema->primaryKey; ?>));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Редактирование <?php echo $this->rod;?>.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['<?php echo  $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo  $this->modelClass; ?>'];

			if($model->save())
                        {
                            Yii::app()->user->setFlash(YFlashMessages::NOTICE_MESSAGE,Yii::t('yupe','Запись обновлена!'));

			    $this->redirect(array('update','id' => $model->id));
                        }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Удаяет модель <?php echo $this->rod;?> из базы.
	 * Если удаление прошло успешно - возвращется в index
	 * @param integer $id идентификатор <?php echo $this->rod;?>, который нужно удалить
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// поддерживаем удаление только из POST-запроса
			$this->loadModel($id)->delete();

                        Yii::app()->user->setFlash(YFlashMessages::NOTICE_MESSAGE,Yii::t('yupe','Запись удалена!'));

			// если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('штвуч'));
		}
		else
			throw new CHttpException(400,'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы');
	}
	/**
	 * Управление <?php echo $this->mtvor;?>.
	 */
	public function actionIndex()
	{
		$model=new <?php echo  $this->modelClass; ?>('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['<?php echo  $this->modelClass; ?>']))
			$model->attributes=$_GET['<?php echo  $this->modelClass; ?>'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Возвращает модель по указанному идентификатору
	 * Если модель не будет найдена - возникнет HTTP-исключение.
	 * @param integer идентификатор нужной модели
	 */
	public function loadModel($id)
	{
		$model=<?php echo  $this->modelClass; ?>::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Запрошенная страница не найдена.');
		return $model;
	}

	/**
	 * Производит AJAX-валидацию
	 * @param CModel модель, которую необходимо валидировать
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='<?php echo  $this->class2id($this->modelClass); ?>-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
