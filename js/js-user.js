$('#create_user').click(function(){
    var new_username = $('#new_username').val();
    var new_email = $('#new_email').val();
    var new_password = $('#new_password').val();
    var re_pw = $('#re_pw').val();

    if(new_username.length == 0) {
        alert('Username không được để trống');
        return false;
    }
    if(new_email.length == 0) {
        alert('Email không được để trống');
        return false;
    }
    if(new_password.length == 0 || re_pw.length == 0) {
        alert('Password dài ít nhất 6 kí tự');
        return false;
    }
    if(new_password != re_pw) {
        alert('Password không trùng khớp');
        return false;
    }
    $.ajax({
        url: "<?php echo base_url();?>user/create",
        type: 'POST',
        data: {
            username: new_username,
            email: new_email,
            password: new_password,
            re_pw: re_pw,
        },
        success: function (result) {
            console.log(result);
            console.log(result.code);
            if (result.code == 1) {
                $('#no_users').hide();
                $("#list_users").prepend('<li id="user_' + result.data + '" class="list-group-item"> '+ new_username +' | ' + new_email + '' +
                    '<span class="badge pull-right" onclick="deleteUser(' + result.data + ')">' +
                    '<i class="fas fa-window-close"></i></span>' +
                    '<span class="badge pull-right">' +
                    '            <a href="user/edit/' + result.data + '"><i class="fas fa-pen-square"></i></a></span>' +
                    ' </li>');

                $('#new_username').val('');
                $('#new_email').val('');
                $('#new_password').val('');
                $('#re_pw').val('');

            } else {
                alert(result.msg);
            }
        },
        error: function (err) {
            alert(err);
        }
    });
});

function deleteUser(id) {
    if(id == '' || id == null) {
        alert('Có lỗi xảy ra. Vui lòng tải lại trang');
        return false;
    }

    var confirm_del = confirm("Xóa vĩnh viễn user này?");
    if (confirm_del == false) {
        return false;
    }

    $.ajax({
        url: "<?php echo base_url();?>user/delete/",
        type: 'POST',
        data: {
            id: id
        },
        success: function (result) {
            console.log(result);
            if (result.code == 1) {
                $("#user_" + id).remove();
                if($('#list_users li').length == 0) {
                    $('#no_users').show();
                }
            } else {
                alert(result.msg);
            }
        },
        error: function (err) {
            alert(err);
        }
    });
}