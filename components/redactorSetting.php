<?php
namespace app\components;

use yii\helpers\Url;

class redactorSetting
{
	public static function _($Id, $imagesDirectory)
	{
		return [
			'lang' => 'ru',
			'minHeight' => 200,
			'replaceDivs' => false,
			'cleanSpaces' => false,
			//'paragraphize' => false,
			'formattingAdd' => [
				0 => [
					'title' => 'Блок 100% зеленая рамка',
					'type' => 'block',
					'tag' => 'p',
					'class' => 'mark-1',
					'clear' => 'remove',
				],
				1 => [
					'title' => 'Блок 100% зеленый фон',
					'type' => 'block',
					'tag' => 'p',
					'class' => 'mark-2',
					'clear' => 'remove',
				],
				2 => [
					'title' => 'Блок (!) слева 55% зеленый фон',
					'type' => 'block',
					'tag' => 'p',
					'class' => 'mark-3',
					'clear' => 'remove',
				],
				3 => [
					'title' => 'Блок (%) слева 55% зеленый фон',
					'type' => 'block',
					'tag' => 'p',
					'class' => 'mark-4',
					'clear' => 'remove',
				],
				4 => [
					'title' => 'Блок (?) слева 55% зеленый фон',
					'type' => 'block',
					'tag' => 'p',
					'class' => 'mark-5',
					'clear' => 'remove',
				],
				5 => [
					'title' => 'Блок («») слева 55% зеленый фон',
					'type' => 'block',
					'tag' => 'p',
					'class' => 'mark-6',
					'clear' => 'remove',
				]
			],
			'imageManagerJson' => Url::to(['/backend/images-get', 'id' => $Id, 'imagesDirectory' => $imagesDirectory]),
			'imageUpload' => Url::to(['/backend/image-upload', 'id' => $Id, 'imagesDirectory' => $imagesDirectory]),
			'fileManagerJson' => Url::to(['/backend/files-get', 'id' => $Id, 'imagesDirectory' => $imagesDirectory]),
			'fileUpload' => Url::to(['/backend/file-upload', 'id' => $Id, 'imagesDirectory' => $imagesDirectory]),
			'plugins' => [
				'imagemanager',
				'filemanager',
				'video',
				'table',
				'definedlinks',
				'fullscreen'
			]
		];
	}
}