// function CheckQuantity(quantity) {
//     var inputElement = $(quantity);
//     var inputValue = inputElement.val();

//     var numericValue = inputValue.replace(/\D/g, '');

//     inputElement.val(numericValue);

//     var num = parseInt(numericValue);

//     if(inputValue == "") {
//         inputElement.val(1);
//     }

//     if (isNaN(num) || num <= 0) {
//         inputElement.val();
//         alert("Bạn chỉ được nhập số và số phải lớn hơn 0");
//     }

//     var defaultQuantity = parseInt(inputElement.data('default-quantity'));

//     if (num > defaultQuantity) {
//         inputElement.val(defaultQuantity);
//     }
// }


// function PreQuantity(element) {
//     var inputElement = $(element).closest('.choice__quantity').find('.input-quantity-cart');
//     var quantity = parseInt(inputElement.val());

//     var defaultQuantity = parseInt(inputElement.data('default-quantity'));

//     if (quantity > defaultQuantity - 1) {
//         alert("Sản phẩm đã giới hạn số lượng của kho");
//         inputElement.val(defaultQuantity);
//     }
//     var productId = inputElement.data('id');

//     var data = {
//         'product_id' : productId,
//         'quantity' : quantity
//     }

//     $.ajax({
//         type: "POST",
//         url: "/serein/cart/quantity/subtract",
//         data: data,
//         dataType: "json",
//         success: function (response) {
//             // inputElement.val(response.cart_quantity);
//             // console.log(response);
//             if(response.success) {
//                 $('#carts').html(response.html);
//             }
//         }
//     });
// }

// function AddQuantity(element) {
//     var inputElement = $(element).closest('.choice__quantity').find('.input-quantity-cart');
//     var quantity = parseInt(inputElement.val());

//     var defaultQuantity = parseInt(inputElement.data('default-quantity'));

//     if (quantity > defaultQuantity - 1) {
//         alert("Sản phẩm đã giới hạn số lượng của kho");
//         inputElement.val(defaultQuantity);
//     }
//     var productId = inputElement.data('id');

//     var data = {
//         'product_id' : productId,
//         'quantity' : quantity
//     }

//     $.ajax({
//         type: "POST",
//         url: "/serein/cart/quantity/add",
//         data: data,
//         dataType: "json",
//         success: function (response) {
//             // inputElement.val(response.cart_quantity);
//             // console.log(response);
//             if(response.success) {
//                 $('#carts').html(response.html);
//             }
//         }
//     });
// }

$('#btn-pay').click(function (e) { 
    e.preventDefault();
    var check = confirm('Bạn đồng ý thanh toán đơn hàng này');
    if(check) {
        $.ajax({
           type: "GET",
           url: "/serein/addOrder",
           dataType: "json",
           success: function (response) {
            //    console.log(response);
               if(response.success) {
                   window.location.href = "http://localhost/serein/order";
                   alert(response.message);
               }else {
                    alert(response.message);
               }
           }
        });
    }
});

$('.choice__remove').click(function() {
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
                success: function(data) {
                    if(data.success) {
                        
                        Swal.fire({
                            title: data.message,
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok',
                            customClass: {
                                popup: 'swal2-custom-size',
                                text: "swal2-text-height",
                            }
                        }).then((result) => {
                            $(`.product__item[data-product-id="${productId}"]`).remove();
                            var itemCount = data.newCarts.length;
                            if(itemCount <= 0) {
                                $('.cart-null').text('Giỏ hàng rỗng');
                            }
                        })

                    }
                }
            })
        }
    });
});
