$(document).ready(function () {
    $('.email').on('input', function () {
        checkemail();
    });

    $('.password').on('input', function () {
        checkpass();
    });

    $('.cpassword').on('input', function () {
        checkcpass();
    });

    $('.name').on('input', function () {
        checkname();
    });

    $('OTP').on('input', function() {
        checkOTP();
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function updateQuantity(action, element) {
        var inputQuantity = $(element).siblings('.quantity-input');
        var quantity = parseInt(inputQuantity.val()) || 1;
        var productId = $(element).closest('.product__item').data('product-id');
        var route = $(inputQuantity).data('route');
    
        if (action === 'add') {
            quantity += 1;
        } else if (action === 'pre') {
            quantity -= 1;
            if (quantity <= 0) {
                Swal.fire({
                    title: 'Số lượng không thể dưới 1',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    customClass: {
                        popup: 'swal2-custom-size',
                        text: "swal2-text-height",
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        quantity = 1;
                        inputQuantity.val(quantity);
                        // Thay vì reload toàn bộ trang, bạn có thể cập nhật lại số lượng và giá tiền tại đây
                        $.ajax({
                            url: route,
                            method: "POST",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                product_id: productId,
                                quantity: quantity
                            },
                            success: function(response) {
                                if (!response.error) {
                                    $(element).closest('.product__item').find('.price__value').text(response.totalPriceProduct);
                                    $('.totalprice .price').text(response.totalPrice);
                                    $('.totalprice .price-total').text(response.totalCartPrice);
                                    $('.totalQuantityCart').html("(" + response.totalQuantityCart +")");
                                }
                            }
                        });
                    }
                    return;
                });
            }
        }
    
        inputQuantity.val(quantity);
    
        $.ajax({
            url: route,
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                product_id: productId,
                quantity: quantity
            },
            success: function(response) {
                if (response.error) {
                    Swal.fire({
                        title: response.error,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                        customClass: {
                            popup: 'swal2-custom-size',
                            text: "swal2-text-height",
                        }
                    });
                } else {
                    $(element).closest('.product__item').find('.price__value').text(response.totalPriceProduct);
                    $('.totalprice .price').text(response.totalPrice);
                    $('.totalprice .price-total').text(response.totalCartPrice);
                    $('.totalQuantityCart').html("(" + response.totalQuantityCart +")");
                }
            }
        });
    
        return quantity;
    }
    
    $(document).on('click', '.add-quantity', function() {
        updateQuantity('add', this);
    });
    
    $(document).on('click', '.pre-quantity', function() {
        updateQuantity('pre', this);
    });
    
    $(document).on('blur', '.quantity-input', function() {
        var inputQuantity = $(this);
        var quantity = parseInt(inputQuantity.val()) || 0;
        var productId = $(this).closest('.product__item').data('product-id');
        var maxQuantity = 100;
    
        if (quantity <= 0 || quantity > maxQuantity || isNaN(quantity)) {
            Swal.fire({
                title: 'Số lượng không hợp lệ',
                text: 'Số lượng phải lớn hơn 0 và nhỏ hơn hoặc bằng ' + maxQuantity,
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',
                customClass: {
                    popup: 'swal2-custom-size',
                    text: "swal2-text-height",
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    quantity = 1;
                    inputQuantity.val(quantity);
                }
            });
        } else {
            $.ajax({
                url: "{{ route('cart.updateQuantity') }}",
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    product_id: productId,
                    quantity: quantity
                },
                success: function(response) {
                    if (response.error) {
                        Swal.fire({
                            title: response.error,
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok',
                            customClass: {
                                popup: 'swal2-custom-size',
                                text: "swal2-text-height",
                            }
                        });
                    } else {
                        inputQuantity.closest('.product__item').find('.price__value').text(response.totalPriceProduct);
                        $('.totalprice .price').text(response.totalPrice);
                        $('.totalprice .text--bold').text(response.totalCartPrice);
                    }
                }
            });
        }
    });
    
    
    $('.quantity-input').on('input', function() {
        var inputQuantity = ('#quantity-input');
        var defaultValue = parseInt(inputQuantity.data('default-quantity'));
        var enteredValue = parseInt(inputQuantity.val()) || 0;
    
        if (enteredValue > defaultValue) {
            alert("Vì số lượng sản phẩm chỉ có " + defaultValue + " nên không thể nhập hơn");
            inputQuantity.val(defaultValue);
        }

    });

});

function checkname() {
    if($('#name') == "") {
        $('#namel_err').html('Không được để trống');
    }
}

function checkuser() {
    var pattern = /^[A-Za-z0-9]+$/;
    var user = $('#username').val();
    var validuser = pattern.test(user);
    if ($('#username').val().length < 4) {
        $('#username_err').html('username length is too short');
        return false;
    } else if (!validuser) {
        $('#username_err').html('username should be a-z ,A-Z only');
        return false;
    } else {
        $('#username_err').html('');
        return true;
    }
}

function checkOTP() {
    var OTP = $('#OTP').val();
    var numericRegex = /^[0-9]+$/;

    if (!numericRegex.test(OTP) || OTP.length !== 6) {
        $('#otp_err').html('Mã OTP phải là 6 chữ số và chỉ chứa số.');
        return false;
    } else {
        $('#otp_err').html('');
        return true;
    }
}
function checkemail() {
    var pattern1 = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    var email = $('#email').val();
    var validemail = pattern1.test(email);
    if (email == "") {
        $('#email_err').html('Không được để trống');
        return false;
    } else {
        if (!validemail) {
            $('#email_err').html('Không phải định dạng email');
            return false;
        } else {
            $('#email_err').html('');
            return true;
        }
    }
}
function checkpass() {
    var pattern2 = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{3,}$/;
    var pass = $('#password').val();
    var validpass = pattern2.test(pass);

    if (pass == "") {
        $('#password_err').html('Mật khẩu không được bỏ trống');
        return false;
    } else if (!validpass) {
        $('#password_err').html('Mật khẩu phải trên 3 kí tự và tối đa 20 kí tự, ít nhất một chữ hoa, một chữ thường, một số và một ký tự đặc biệt:');
        return false;

    } else {
        $('#password_err').html("");
        return true;
    }
}
function checkcpass() {
    var pass = $('#password').val();
    var cpass = $('#cpassword').val();
    if (cpass == "") {
        $('#cpassword_err').html('Xác nhận mật khẩu không được để trống');
        return false;
    } else if (pass !== cpass) {
        $('#cpassword_err').html('Xác nhận mật khẩu không khớp');
        return false;
    } else {
        $('#cpassword_err').html('');
        return true;
    }
}

function password_show_hide() {
    console.log('ok');
    var x = document.getElementById("password");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}
