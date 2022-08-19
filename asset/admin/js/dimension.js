$('#login-form').submit(function (e) {
        var _this = $(this);
        _this.find("[type='submit']").prop('disabled', true);
        e.preventDefault();
        $.ajax({
            url: _this.attr('action'),
            type: "POST",
            data: $('#login-form').serialize(),
            success: function (res)
            {
                _this.find("[type='submit']").prop('disabled', false);
                console.log(res);
                res = JSON.parse(res);
                if (res.success==false) {
                    showMessage('error', {message: res.message});
                } else {
                    showMessage('success', {message: res.message});
                    window.location.href=base_url+"admin/add_data/dimension";
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                _this.find("[type='submit']").prop('disabled', false);
                showMessage('error', 'Internal error: ' + jqXHR.responseText);
            }
        });
    });
    $('#createuser-form').submit(function (e) {
        var _this = $(this);
        _this.find("[type='submit']").prop('disabled', true);
        e.preventDefault();
        $.ajax({
            url: _this.attr('action'),
            type: "POST",
            data: $('#createuser-form').serialize(),
            success: function (res)
            {
                _this.find("[type='submit']").prop('disabled', false);
                if (res.success==false) {
                    showToastMessage('Error', res.message,'error');
                } else {
                    showToastMessage('Success', res.message, 'success');
                    redirectUrl("admin/add_data/dimension",3000);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                _this.find("[type='submit']").prop('disabled', false);
                showToastMessage('Error',  jqXHR.responseText,'error');
            }
        });

    });

    $(".select2").select2();
