$(document).ready(function () {

    $('.saveInfo').click(function () {

        var img = $('#avatar').attr('src');
        var data = {
            name: $('#name').val(),
            avatar: img.replace("/serein/", ""),
            email: $('#email').val(),
            phone: $('#phone').val(),
            address: $('#address').val(),
            sex: $('#sex').val(),
        }

        $.ajax({
            type: "POST",
            url: "/serein/user/info/save",
            data: data,
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.success) {
                    alert(response.message);
                } else {
                    $('#message_err').text(response.message);
                }
            }
        });
    })

    $('#ressetPass-btn').click(function (e) {
        e.preventDefault();
        var email = $('#email').val();

        var data = {
            email: email
        }

        $.ajax({
            type: "POST",
            url: "/serein/handleressetPassword",
            data: data,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    window.location.href = "http://localhost/serein/passwordNew";
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error: " + status, error);
                alert("An error occurred while sending the email. Please try again later.");
            }
        });

    });

    $('.delete-button').on('click', function () {
        var id = $(this).data('id');
        var routeDelete = $(this).data('route-delete');
        var routeCheck = $(this).data('route-check');
        var confirmMesage = $(this).data('confirm');

        Swal.fire({
            title: 'Bạn có chắc muốn xóa?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy',
            customClass: {
                popup: 'swal2-custom-size',
                text: "swal2-text-height",
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: routeCheck,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id
                    },
                    success: function (response) {
                        if (response.exists) {
                            Swal.fire({
                                title: "Bạn có chắc chắn sẽ xóa ?",
                                icon: "error",
                                text: confirmMesage,
                                showCancelButton: true,
                                confirmButtonText: 'Đồng ý',
                                cancelButtonText: 'Không đồng ý',
                                cancelButtonColor: "#3085d6",
                                confirmButtonColor: '#d33',
                                customClass: {
                                    popup: 'swal2-custom-size',
                                    text: "swal2-text-height",
                                }
                            }).then((check) => {
                                if(check.isConfirmed) {
                                    deleteItem(id, routeDelete);
                                }
                            })
                        } else {
                            deleteItem(id, routeDelete);
                            // console.log(response.test);
                        }
                    },
                    error: function (xhr) {
                        // console.log(xhr.responseText); // Kiểm tra lỗi từ server
                    }
                });
            }
        })
    });

    function deleteItem(id, routeDelete) {

        $.ajax({
            url: routeDelete,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                // location.reload();

                Swal.fire({
                    title: response.message,
                    icon: 'success'
                }).then(() => {
                    $('a[data-id="' + id + '"]').closest('tr').remove();
                    location.reload();
                });
            },
            error: function (xhr) {
                console.log(xhr.responseText); // Kiểm tra lỗi từ server
            }
        });
    }

    $('.print').on('click', function(event) {
        event.preventDefault();
        var apiRoute = $(this).data('route-api');

        $.ajax({
            url: apiRoute,
            method: 'GET',
            success: function(response) {
                var printWindow = window.open('', '', 'height=700,width=700');
                printWindow.document.write(response);
                printWindow.document.close();
                printWindow.print();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching order:', error);
            }
        });
    });
})

