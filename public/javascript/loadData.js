$(document).ready(function () {
    var currentPage = 1;
    var itemsPerPage = 5;

    loadProducts(currentPage, itemsPerPage);

    function loadProducts(page, perPage) {
        $.ajax({
            url: 'app/Api/Orders/orders.php',
            type: 'GET',
            dataType: 'json',
            data: {
                page: page,
                perPage: perPage
            },
            success: function (response) {
                $('#orders').html(displayProducts(response.data));
                $('#pagi').html(renderPagination(response.totalPages, currentPage));
            },
            error: function (xhr, status, error) {
                console.log('Fail');
            }
        });
    }

    function displayProducts(products) {
        var html = "";
        $.each(products, function (index, element) {
            html += `
            <tr class="manager-list">
                <td class="manager-name"><span>${index}</span></td>
                <td class="manager-price"><span>${element.total_amount.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })}</span></td>
                <td class="manager-name"><span>${element.user_name}</span></td>
                <td class="manager-name"><span>${element.voucher || "Không có"}</span></td>
                <td class="manager-name"><span>${element.status_name}</span></td>
                <td class="manager-name"><span>${element.status_time}</span></td>
                <td class="manager-createDay"><span>${element.created_at}</span></td>
                <td class="manager-action">
                    <a href="http://localhost/serein/admin/orders/update/${element.id}" class="manager-action-item bill_detail update-status">
                        <button name="bill_detail" class="bill_detail-item">Update</button>
                    </a>
                    <a href="http://localhost/serein/admin/orders/detail/${element.id}" class="manager-action-item bill_detail">
                        <button name="bill_detail" class="bill_detail-item">Detail</button>
                    </a>
                    <a data-order-id="${element.id}" class="manager-action-item bill_detail print_order">
                        <button name="bill_detail" class="bill_detail-item">In</button>
                    </a>
                </td>
            </tr>`;
        });
        return html;   
    }
    // " 

    // $(document).on('click', '.update-status', function(e) {
    //     e.preventDefault();
    //     var product_id = $(this).closest('.manager-list').find('.id-order').val();
    //     $.ajax({
    //         type: "POST",
    //         url: "/serein/admin/orders/update/",
    //         data: {
    //             product_id
    //         },
    //         dataType: "json",
    //         success: function (response) {
    //             console.log(response);
    //         }
    //     });
    // });

    $(document).on('click', '.print', function(event) {
        event.preventDefault();
        var apiRoute = $(this).data('route-api');
    
        var iframe = document.createElement('iframe');
        iframe.style.display = 'none';
    
        document.body.appendChild(iframe);
    
        $.ajax({
            url: apiRoute,
            method: 'GET',
            success: function(response) {
                iframe.contentDocument.open();
                iframe.contentDocument.write(response);
                iframe.contentDocument.close();
    
                iframe.onload = function() {
                    iframe.contentWindow.focus();
                    iframe.contentWindow.print();
                    document.body.removeChild(iframe);
                };
            },
            error: function(xhr, status, error) {
                console.error('Error fetching order:', error);
                document.body.removeChild(iframe);
            }
        });
    });
    

    $(document).on('click', '.page-link', function (e) {
        e.preventDefault();
        var page = $(this).data('page');
        currentPage = page; // Cập nhật currentPage trước khi tải sản phẩm
        loadProducts(page, itemsPerPage);
    });

    function renderPagination(totalPages, currentPage) {
        var html = '';

        for (var i = 1; i <= totalPages; i++) {
            var activeClass = i === currentPage ? 'active' : '';
            html += `<a class="page-link ${activeClass}" href="#" data-page="${i}">${i}</a>`;
        }

        return html;
    }
});
