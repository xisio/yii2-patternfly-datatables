<?php
namespace xisio\patternfly\datatables;

use Yii;
use yii\helpers\Html;
use yii\grid\ActionColumn;

class PatternflyActionList extends ActionColumn
{
	public $buttons = [
		'show' => [
			'icon' => 'eye-open',
		],
		'update' => [
			'icon' => 'pficon-edit',
		],
		'delete' => [
			'icon' => 'pficon-delete',
			'options' => [
				'data-confirm' => 'Wollen Sie diesen Eintrag wirklich löschen?',
				'data-method' => 'post',
				'click' => '$(this).closest("tr").remove();',
			]
		]
	];
	public function init() {
		$this->initDefaultButtons();
	}

    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'eye-open');
        $this->initDefaultButton('update', 'pficon-edit');
        $this->initDefaultButton('delete', 'pficon-delete', [
            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
            'data-method' => 'post',
        ]);
    }

	protected function initDefaultButton($name, $iconName, $additionalOptions = [])
	{
		if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
			$this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
				switch ($name) {
				case 'view':
					$title = Yii::t('yii', 'View');
					break;
				case 'update':
					$title = Yii::t('yii', 'Update');
					break;
				case 'delete':
					$title = Yii::t('yii', 'Delete');
					break;
				default:
					$title = ucfirst($name);
				}
				$options = array_merge([
					'title' => $title,
					'aria-label' => $title,
					'data-pjax' => '0',
				], $additionalOptions, $this->buttonOptions);
				$icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-$iconName"]);
				return Html::a($icon, $url, $options);
			};
		}
	}
}
