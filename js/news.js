$('document').ready(function() {
	var ids = [];

	$.ajax({
		url: '/news/main',
		type: 'POST',
		cache:  false,
		data: {'interval': true},
		timeout: 10000,
		success: function(msg) {
			var data = JSON.parse(msg);

			for(key in data) {
				if($.inArray(data[key].id, ids) == -1) {
					ids.push(data[key].id);

					$('.comm-content').append(
						'<div class="comm"><b>' + data[key].id + '. ' +
						 data[key].title + '</b>' + 
						'<div class="comm-date">' + data[key].date + 
						'</div><div class="clear"></div>' +	data[key].text +'</div>'
					);
				}
			}
		},
		error: function() {
			alert('Произошла ошибка при передаче данных');
		}
	});


	function showMe() {
		$.ajax({
			url: '/news/main',
			type: 'POST',
			cache:  false,
			data: {'interval': true},
			timeout: 10000,
			success: function(msg) {
				var data = JSON.parse(msg);
				for(key in data) {
					if($.inArray(data[key].id, ids) == -1) {
						ids.push(data[key].id);

						$('.comm-content').append(
							'<div class="comm"><b>' + data[key].id + '. ' +
							 data[key].title + '</b>' + 
							'<div class="comm-date">' + data[key].date + 
							'</div><div class="clear"></div>' +	data[key].text +'</div>'
						);
					}
				}
			},
			error: function() {
				alert('Произошла ошибка при передаче данных');
			}
		})
	}
	
	var inter = setInterval(showMe, 3000);

	$('#newsSubm').click(function(){
		var send = $('#newsForm').serializeArray();

		$.ajax({
			url: '/news/main',
			type: 'POST',
			cache: false,
			data: send,
			timeout: 10000,
			success: function(msg) {
				if(msg) {
					var data = JSON.parse(msg);
					if(!data.error) {
						$('#newsTitle, #newsText').val('');
					} else {
						$('#log-notice').html(data.error);
						$('#newsTitle, #newsText').css('border', '1px solid red');
					}
				} else {
					alert('Новость не была добавлена');
				}
			}, 
			error: function() {
				alert('Произошла ошибка при передаче данных');
			}
		});
	});

})