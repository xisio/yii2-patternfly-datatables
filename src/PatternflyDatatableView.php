<?php
namespace xisio\patternfly\datatables;

use Yii;
use yii\grid\GridView;
use xisio\patternfly\datatables\assets\PatternflyBootstrapAsset;
use xisio\datatables\Datatables;

class PatternflyDatatables extends Datatables
{
	public $columns = [];
	//public $table_class='table-striped table-hover display';
	public $table_class='table table-striped table-bordered table-hover dataTable no-footer';

	/**
     * @var array the HTML attributes for the container tag of the grid view.
     * The "tag" element specifies the tag name of the container element and defaults to "div".
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
	public $options = ['class' => 'grid-view'];


	public function run() {
		$clientOptions = $this->getClientOptions();
		$id = $this->tableOptions['id'];
		PatternflyBootstrapAsset::register($view);

		$options = Json::encode($clientOptions);
		$view->registerJs("jQuery('#$id').DataTable($options);");
	}
}
