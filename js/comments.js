$('document').ready(function() {
	$('#idSubm').click(function(){
		var send = $('#commentForm').serializeArray();

		$.ajax({
			url: '/comments/main',
			type: 'POST',
			cache:   false,
			data: send,
			timeout: 10000,
			beforeSend: function() {
				$('#loader').show();
			},
			success: function(msg) {
				if(msg) {
					var data = JSON.parse(msg);
					if(!data.error) {
						$('.comm-content').append(
						'<a class="del-from-adm" href="/admin/comments/main/del/'+ data.id 
						+'">удалить</a>' +
						'<div class="clear"></div>' +
						'<div class="comm"><b>' + data.id + '. ' + data.name + '</b>' + 
						'<div class="comm-date">' + data.date + '</div><div class="clear"></div>' +
						data.text +'</div>'
						);
						$('#commLogin, #commTextArea').val('');
					} else {
						$('#log-notice').html(data.error);
						$('#commLogin, #commTextArea').css('border', '1px solid red');
					}	
				} else {
					alert('Новость не была добавлена');
				}
			}, 
			complete: function() {
				$('#loader').hide();
			},
			error: function() {
				alert('Произошла ошибка при передаче данных');
			}
		});
	});
})