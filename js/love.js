$(document).ready(function () {
    $('#send').click(function(){
        if ($('#content').val() == ''){
            $('#content').addClass('is-invalid');
            $('#errorContent').text('Vui lòng không để trống trường này !');
        } else if  ($('#content').val().length > 200) {
            $('#content').addClass('is-invalid');
            $('#errorContent').text('Vui lòng nhập nội dung không quá 200 kí tự !');
        } else {
            $('#content').removeClass('is-invalid');
            $.ajax({
                type: "POST",
                dataType: "json",
                url: window.location.protocol + window.location.pathname,
                data: {'content': $("#content").val()},
                beforeSend: function(){
					$('#send').attr('disabled', 'true').html('Loading...');
				},
            }).done(function(event) {
				$('#send').removeAttr('disabled').html('Gửi');
				if(event.status == 1 ){
					Swal.fire({
						icon: 'success',
						title: 'Thành công',
						html: event.html
					})
				}else{
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						html: event.html
					})
				}
			})
			.fail(function() {
				$('#send').removeAttr('disabled').html('Gửi');
				console.log("error");
			});
        }   
    })
});

function myFunction() {
	/* Get the text field */
	var copyText = document.getElementById("copytoclipboard");

	/* Copy the text inside the text field */
	navigator.clipboard.writeText(copyText.innerHTML);

	/* Alert the copied text */
	Swal.fire({
		icon: 'success',
		title: 'Thông báo !',
		html: 'Copy link thành công, Hãy gửi ngay cho người bạn thương nha ❤️❤️❤️'
	});
}