$(function () {
    $.ajaxSetup({
        beforeSend: function () {
            $("#mpreloader").fadeToggle();
        }, complete: function () {
            $("#mpreloader").fadeToggle();
        }
    });
    $('input[role="permission"]').attr('checked', false);
    $("[viewer]").change((e) => {
        liveView(e.target, $(e.target).attr("viewer"))
    });
    $(".permission-group").click(function (e) {
        $(this).find('input[role="permission"]').click();
    });

    $('input[role="permission"]').change(function (e) {
        if ($(this).val() == 1) {
            if (e.target.checked) {
                $('input[role="permission"]').prop('checked', 'checked');
                $(".permission-group").addClass("active");
            } else {
                $('input[role="permission"]').prop('checked', '');
                $(".permission-group").removeClass("active");
            }
        } else {
            $(this).parentsUntil(".permission-group").parent().toggleClass('active');
        }
        if ($('input[role="permission"]:not(input[code="admin"]):is(:checked)').length >= $('input[role="permission"]:not(input[code="admin"])').length) {
            $('input[code="admin"]').prop('checked', 'checked');
            $("div[code='admin']").addClass('active');
        } else {
            $('input[code="admin"]').prop('checked', '');
            $("div[code='admin']").removeClass('active');
        }

    });
    $(".allpermissions input[name='mPermission']").each(function (i, e) {
        $('.permission-container input[value="' + $(this).val() + '"]').click();
    });

    var base_url = $('meta[name="base_url"]').attr('content');
    var page = $('[name="model"]').val();
    $("[role='delete-btn']").click(function (e) {
        let recordid = ($(this).attr("record-id"));
        console.log(page + '/delete/' + recordid);
        $("[role='delete-form']").attr("action", "/" + page + '/delete/' + recordid);
        $("[role='delete-form'] input[name='id']").val(recordid);
        currentRow = $(this).parentsUntil("tr").parent();
        swal({
            title: "Delete",
            text: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((ok) => {
            if (ok) {
                $("[role='delete-form']").submit();
            }
        });
    });
    $(".user-logout-form").submit(function (e) {
        e.preventDefault();
        swal({
            title: "Logout",
            text: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((ok) => {
            if (ok) {
                e.currentTarget.submit();
            }
        });
    });
    deleteForm("#user-delete-form");
    deleteForm("#role-delete-form");
    function deleteForm(formid) {
        $(formid).submit(function (e) {
            console.log($(this).attr("action"));
            e.preventDefault();
            data = $(this).serialize();
            $.ajax({
                url: $(this).attr("action"),
                data: data,
                type: $(this).attr("method"),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (msg) {
                    swal("success!", "", "success")
                    currentRow.remove();
                },
                error: function (req, status, error) {
                    swal("error", "failed!", "error");
                }
            });
        });

    }
    $("[btn-target]").click((e) => $($(e.target).attr("btn-target")).click());
    function liveView(input, viewer) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(viewer).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
    function referesh() {
        setTimeout(() => {
            window.location = window.location;
        }, 1000);
    }
    submitForm("#resetPassword", (msg) => {
        if (msg == 'success') {
            swal("success", "success", "success");
            referesh();
        }
    });

    submitForm("#user-profile", (msg) => {
        if (msg == 'success') {
            swal("success", "success", "success");
            referesh();
        }
    });
    submitForm("#change-password", (msg) => {
        if (msg == 'success') {
            swal("success", "success", "success");
            referesh();
        }else{
            swal("",msg,"warning");
        }
    },()=>{
        if($("#renewPassword").val() != $("#newPassword").val()){
            swal("Password not matched!","Make sure you entered password correctly","info");
            return true;
        }
        return false;
    });
    submitForm("#user-profile", (msg) => {
        if (msg == 'success') {
            swal("success", "success", "success");
            referesh();
        }
    }); 

    submitForm("#lockForm", (msg) => {
        if (msg == 'success') {
            swal("success", "success", "success");
            referesh();
        }
    });
    submitForm("#login-form", (msg) => {
        if (msg != "success")
            swal("", msg, "warning");
        else
            window.location = window.location;
    }, null);
    submitForm("#user-form", (msg) => {
        swal("success", "success", "success");
        redirctToIndexPage();
    });
    submitForm("#role-form", (msg) => {
        swal("success", "success", "success");
        redirctToIndexPage();
    }, () => {
        if ($('input[role="permission"]:is(:checked)').length == 0) {
            swal("", "Please select 1 permission at least.", "warning");
            return true
        }
        return false;
    });
    function redirctToIndexPage() {
        setTimeout(() => {
            window.location = base_url + '/' + page;
        }, 1500);
    }
    function submitForm(formid, onSuccess, validation) {
        $(formid).submit(function (e) {
            e.preventDefault();
            if (validation) {
                if (validation())
                    return;
            }
            data = new FormData(this);
            $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function () {
                    $("#mpreloader").fadeToggle();
                }, complete: function () {
                    $("#mpreloader").fadeToggle();
                },
                success: function (msg) {
                    onSuccess(msg);
                },
                error: function (req, status, error) {
                    let msg = "";
                    if (req != undefined) {
                        try {
                            var response = JSON.parse(req.responseText);
                            Object.keys(response.errors).forEach(function (k) {
                                msg += k + ' - ' + response.errors[k] + "\n";
                            });
                            swal("error", msg, "error");
                        } catch (error) {
                            errorMessage();
                        }
                    } else {
                        errorMessage();
                    }
                }
            });
        });
    }
    function errorMessage() {
        swal("Error", "Job Failed! Make Sure All fields filled correctly, and the  try again!", "error");
    }

});