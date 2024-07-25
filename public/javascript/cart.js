
$('#btn-pay').click(function (e) {
    e.preventDefault();
    var check = confirm('Bạn đồng ý thanh toán đơn hàng này');
    if (check) {
        $.ajax({
            type: "GET",
            url: "/serein/addOrder",
            dataType: "json",
            success: function (response) {
                //    console.log(response);
                if (response.success) {
                    window.location.href = "http://localhost/serein/order";
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            }
        });
    }
});

$('.choice__remove').click(function () {
    var route = $(this).data('route');
    var productId = $(this).closest('.product__item').data('product-id'); // Lấy id sản phẩm
    Swal.fire({
        title: 'Bạn có chắc muốn xóa?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy',
        customClass: {
            popup: 'swal2-custom-size',
            text: "swal2-text-height",
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: route,
                method: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (data) {
                    if (data.success) {

                        Swal.fire({
                            title: data.message,
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok',
                            customClass: {
                                popup: 'swal2-custom-size',
                                text: "swal2-text-height",
                            }
                        }).then(() => {
                            // Xóa sản phẩm khỏi DOM
                            $(`.product__item[data-product-id="${productId}"]`).remove();

                            // Cập nhật tổng giá sản phẩm và tổng tiền
                            var newCarts = data.newCarts;

                            // Chuyển đổi đối tượng thành mảng
                            var cartItems = Array.isArray(newCarts) ? newCarts : Object.values(newCarts);

                            var totalPriceProduct = 0;
                            var totalPrice = 0;

                            cartItems.forEach(function (item) {
                                totalPriceProduct += item.price * item.quantity;
                            });

                            totalPrice = totalPriceProduct + 18000;

                            $('#totalPriceProduct').text(totalPriceProduct.toLocaleString('vi-VN'));
                            $('#totalPrice').text(totalPrice.toLocaleString('vi-VN'));

                            if (cartItems.length <= 0) {
                                $('.paymentCart').css('display', 'none');
                                $('.cart-null').text('Giỏ hàng rỗng');
                            }
                        });
                    }
                }
            });
        }
    });
});


