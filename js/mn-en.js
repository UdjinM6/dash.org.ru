$("#log").click(function(e) {
	$(this).blur();
	e.preventDefault();
	key = $('input[id=private_key]').val();
	$('#myModal').modal('show');
	$.post("//dash.org.ru/public/mn.php?control=log", { key: key }, function( data ){
		$('#myModal').modal('hide');
		if(data == 'no_key'){
			alertify.error("Wrong key");
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
			alertify.error("Wrong key");
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
			alertify.error("Wrong key");
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
			alertify.error("Wrong key");
			return;
		}
		if(data == 'OK'){
			alertify.success("MN work");
			return;
		}else{
			alertify.error("MN not work");
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
			alertify.error("Empty value");
			return;
		}
		if(data == 'wrong_txid'){
			alertify.error("Wrong transaction number");
			return;
		}
		if(data == 'full'){
			alertify.error("no free slots");
			return;
		}
		if(data == 'not_15_conf'){
			alertify.error("Wait for 15 confirmations");
			return;
		}
		if(data == 'not_1000_DASH_TX'){
			alertify.error("Wrong transaction");
			return;
		}
		if(data == 'not_1000_DASH_BALANCE'){
			alertify.error("Your balance != 1000 DASH");
			return;
		}
		if(data == 'error'){
			alertify.error("Error");
			return;
		}
		if(data == 'mn_work'){
			alertify.error("MN already working");
			return;
		}
		window.location = "//dash.org.ru/public/mn.php?download=getfile&data="+data;
	});
});
