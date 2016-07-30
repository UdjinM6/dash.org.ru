if (window.location.protocol != "https:")
    window.location.href = "https:" + window.location.href.substring(window.location.protocol.length);

$("#setup").click(function(e) {
	$(this).blur();
	e.preventDefault();
	txid = $('input[id=txid]').val();
	$('#myModal').modal('show');
	$.post("//dash.org.ru/public/mn.php", { txid: txid }, function( data ){
		//console.log(data);
		$('#myModal').modal('hide');
		if(data == 'empty'){
			alertify.error("Empty value");
			return;
		}
		if(data == 'wrong_txid'){
			alertify.error("Wrong txid");
			return;
		}
		if(data == 'full'){
			alertify.error("No free slots");
			return;
		}
		if(data == 'not_15_conf'){
			alertify.error("Wiat 15 confirmation");
			return;
		}
		if(data == 'not_1000_DASH_TX'){
			alertify.error("Wrong txid");
			return;
		}
		if(data == 'not_1000_DASH_BALANCE'){
			alertify.error("Balance != 1000 DASH");
			return;
		}
		if(data == 'error'){
			alertify.error("Error");
			return;
		}
		if(data == 'mn_work'){
			alertify.error("MN already work");
			return;
		}
		window.location = "//dash.org.ru/public/mn.php?download=getfile&data="+data;
	});
});
