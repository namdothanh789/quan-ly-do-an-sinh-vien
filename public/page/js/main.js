$(document).ready(function () {
    $('.topic-registration').click(function (event) {
        event.preventDefault();

        var url = $(this).attr('url');
        var currentPage = location.href;

        Swal.fire({
            title: 'Bạn chắc chắn muốn đăng ký đề tài ?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Đăng ký',
            denyButtonText: "Hủy",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.value) {

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                }).done(function (result) {
                    if (result.code == 1) {
                        Swal.fire(result.message, '', 'success');
                        location.href = currentPage;
                        return true;
                    }
                    Swal.fire(result.message, '', 'error');
                    return false;
                })
            }
        })
    })
});