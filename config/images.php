<?php
//use app\modules\file\components\Thumbnailer;

// откуда будем резать тамб у картинки
/**
* 0 - Если картинка вертикальная - то миниатюра будет браться сверху, если горизонтальная - слева.
* (Имеет смысл только при типе "2", в других случаях миниатюра
* всегда будет полностью видима)
*/

/**
* 1 - Миниатюра будет взята с центра картинки
*/

/**
* 2 - Если картинка вертикальная - то миниатюра будет браться снизу, если горизонтальная - справа.
* (Имеет смысл только при типе "0", в других случаях миниатюра
* всегда будет полностью видима)
*/

// как будем резать тамб
/**
* 0 - Миниатюра будет строго указанного размера, если соотношения сторон исходного изображения и
* миниатюры не совпадают - то останутся полосы указанного цвета.
*/
 
/**
* 1 - Одна из сторон миниатюры будет строго заданного размера, а другая - меньше настолько,
* чтобы совпало соотношение сторон.
*/

/**
* 2 - Миниатюра будет строго указанного размера и на ней не будет полос, но если соотношения
* сторон миниатюры и исходного изображения не совпадут, то миниатюра будет содержать не всю
* картинку, а только её часть.
* (Какая часть будет содержаться в миниатюре указывается параметром Thumbnailer::THUMBNAIL_LOCATION_*)
*/

return [
    'versions' => [
		'1920x1080' => [
            'uploadDir' => '1920x1080/',
            'width' => 1920,
            'height' => 1080,
			'locationMode' => 1,// Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 1, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
            'quality' => 80,
			'isDefault' => FALSE,
        ],
		'1920x846' => [
            'uploadDir' => '1920x846/',
            'width' => 1920,
            'height' => 846,
			'locationMode' => 1,// Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 1, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
            'quality' => 80,
			'isDefault' => FALSE,
        ],
		'1200x700' => [
            'uploadDir' => '1200x700/',
            'width' => 1200,
            'height' => 700,
			'locationMode' => 1, //Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
            'quality' => 80,
			'isDefault' => FALSE,
        ],
		'1000x1400' => [
            'uploadDir' => '1000x1400/',
            'width' => 1000,
            'height' => 1400,
			'locationMode' => 1, //Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
            'quality' => 80,
			'isDefault' => FALSE,
        ],
		'959x600' => [
            'uploadDir' => '959x600/',
            'width' => 959,
            'height' => 600,
			'locationMode' => 1, //Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
            'quality' => 80,
			'isDefault' => FALSE,
        ],
		'500x700' => [
            'uploadDir' => '500x700/',
            'width' => 500,
            'height' => 700,
			'locationMode' => 1, //Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
            'quality' => 80,
			'isDefault' => FALSE,
        ],
		'600x300' => [
            'uploadDir' => '600x300/',
            'width' => 600,
            'height' => 300,
			'locationMode' => 1, //Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
            'quality' => 80,
			'isDefault' => FALSE,
        ],
		'400x300' => [
            'uploadDir' => '400x300/',
            'width' => 400,
            'height' => 300,
			'locationMode' => 1, //Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
            'quality' => 80,
			'isDefault' => FALSE,
        ],
		'500x150' => [
            'uploadDir' => '500x150/',
            'width' => 500,
            'height' => 150,
			'locationMode' => 1, //Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
            'quality' => 80,
			'isDefault' => FALSE,
        ],
		'360x180' => [
            'uploadDir' => '360x180/',
            'width' => 360,
            'height' => 180,
			'locationMode' => 0, //Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
            'quality' => 80,
			'isDefault' => FALSE,
        ],
		'160x80' => [
            'uploadDir' => '160x80/',
            'width' => 160,
            'height' => 80,
			'locationMode' => 0, //Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
            'quality' => 80,
			'isDefault' => FALSE,
        ],
		'thumbgall' => [
            'uploadDir' => 'thumbgall/',
            'width' => FALSE,
            'height' => 100,
			'locationMode' => 1, //Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 1, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
            'quality' => 80,
			'isDefault' => FALSE,
        ],
        'thumbnail' => [
            'uploadDir' => 'thumbnail/',
            'width' => 100,
            'height' => FALSE,
			'locationMode' => 1, //Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 1, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
            'quality' => 80,
			'isDefault' => TRUE,
        ],
    ],
    'paths' => [
		'downloadDir' => '/files/',
        'uploadDir' => '@webroot/files/',
		'nophotoDir' => 'nophoto/',
		'nophotoFilename' => 'no_photo.jpg',
    ],
];