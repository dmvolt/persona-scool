$(function () {
	$('[data-toggle="tooltip"]').tooltip();
});

/********** Удаление изображений в админке ***********/
function deleteImage(imagesDirectory, contentId, fileName, fileId){
	if(confirm('Вы уверены, что хотите удалить это изображение?')){
		
		$.post(
			'/preadmin/delete-image',
			'imagesDirectory=' + imagesDirectory + '&contentId=' + contentId + '&fileName=' + fileName + '&fileId=' + fileId
		)
		.done(function(result){
			if(result == 'success'){
				$('#'+imagesDirectory+'_'+contentId+'_'+fileId+'_imageblock').hide();
			}
		});
	}
	return false;
}

/********** Удаление файлов в админке ***********/
function deleteVideo(fileDirectory, contentId, fileName, fileId){
	if(confirm('Вы уверены, что хотите удалить этот файл?')){
		
		$.post(
			'/preadmin/delete-video',
			'fileDirectory=' + fileDirectory + '&contentId=' + contentId + '&fileName=' + fileName + '&fileId=' + fileId
		)
		.done(function(result){
			if(result == 'success'){
				$('#'+fileDirectory+'_'+contentId+'_'+fileId+'_fileblock').hide();
			}
		});
	}
	return false;
}

/********** Массовое редактирование(удаление) материалов ***********/
function multiUpdate(){
	if(confirm('Вы уверены, что хотите присвоить новые значения полям? !Внимание: выбранные для удаления материалы будут безвозвратно удалены!')){
		$('#update_form').submit();
	}
	return false;
}

/********** Переключатель статуса материала ***********/
$('.switcher').click(function(){
	if($(this).hasClass('on')) {

		$(this).removeClass('label-success');
		$(this).removeClass('on');
		$(this).addClass('off');
		$(this).addClass('label-default');
		$(this).attr('title', 'Активировать');
		$(this).text('Отключен');
		$($(this).next()).attr('value', 0);

	} else if($(this).hasClass('off')) {

		$(this).removeClass('label-default');
		$(this).removeClass('off');
		$(this).addClass('on');
		$(this).addClass('label-success');
		$(this).attr('title', 'Отключить');
		$(this).text('Активен');
		$($(this).next()).attr('value', 1);
	}
});