$("#log").click(function(e) {
	$(this).blur();
	e.preventDefault();
	key = $('input[id=private_key]').val();
	$('#myModal').modal('show');
	$.post("//dash.org.ru/public/mn.php?control=log", { key: key }, function( data ){
		$('#myModal').modal('hide');
		if(data == 'no_key'){
			alertify.error("Неправильный ключ");
			return;
		}
		window.location = data;
	});
});

$("#info").click(function(e) {
	$(this).blur();
	e.preventDefault();
	key = $('input[id=private_key]').val();
	$('#myModal').modal('show');
	$.post("//dash.org.ru/public/mn.php?control=info", { key: key }, function( data ){
		$('#myModal').modal('hide');
		if(data == 'no_key'){
			alertify.error("Неправильный ключ");
			return;
		}
		window.location = data;
	});
});

$("#restart").click(function(e) {
	$(this).blur();
	e.preventDefault();
	key = $('input[id=private_key]').val();
	$('#myModal').modal('show');
	$.post("//dash.org.ru/public/mn.php?control=restart", { key: key }, function( data ){
		$('#myModal').modal('hide');
		if(data == 'no_key'){
			alertify.error("Неправильный ключ");
			return;
		}
		alertify.success("Готово");
	});
});

$("#status").click(function(e) {
	$(this).blur();
	e.preventDefault();
	key = $('input[id=private_key]').val();
	$('#myModal').modal('show');
	$.post("//dash.org.ru/public/mn.php?control=status", { key: key }, function( data ){
		$('#myModal').modal('hide');
		if(data == 'no_key'){
			alertify.error("Неправильный ключ");
			return;
		}
		if(data == 'OK'){
			alertify.success("Ваша MN работает");
			return;
		}else{
			alertify.error("Ваша MN не работает");
			return;
		}
	});
});

$("#setup").click(function(e) {
	$(this).blur();
	e.preventDefault();
	txid = $('input[id=txid]').val();
	$('#myModal').modal('show');
	$.post("//dash.org.ru/public/mn.php", { txid: txid }, function( data ){
		$('#myModal').modal('hide');
		if(data == 'empty'){
			alertify.error("Пустое значение");
			return;
		}
		if(data == 'wrong_txid'){
			alertify.error("Неправильный номер транзакции");
			return;
		}
		if(data == 'full'){
			alertify.error("Нет мест");
			return;
		}
		if(data == 'not_15_conf'){
			alertify.error("Дождитесь 15 подтверждений");
			return;
		}
		if(data == 'not_1000_DASH_TX'){
			alertify.error("Неправильная транзакция");
			return;
		}
		if(data == 'not_1000_DASH_BALANCE'){
			alertify.error("Ваш баланс != 1000 DASH");
			return;
		}
		if(data == 'error'){
			alertify.error("Ошибка");
			return;
		}
		if(data == 'mn_work'){
			alertify.error("MN уже работает");
			return;
		}
		window.location = "//dash.org.ru/public/mn.php?download=getfile&data="+data;
	});
});
