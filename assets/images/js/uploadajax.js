$(document).ready(function() {
    $('#multiFiles').change(function() {
        var error = '';
        var fileLength = document.getElementById('multiFiles').files.length;
        if (fileLength > 0) {
            var form_data = new FormData();
            var arrTypeFileAllow = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
            for (var x = 0; x < fileLength; x++) {
                var files = document.getElementById('multiFiles').files[x];
                if (!((files.type == arrTypeFileAllow[0]) || (files.type == arrTypeFileAllow[1]) || (files.type == arrTypeFileAllow[2]) || (files.type == arrTypeFileAllow[3]))) {
                    alert('Chỉ được tải lên các định dạng đuôi: .jpg, .jpeg, .png');
                } else {
                    form_data.append("files[]", files);
                }
            }
            $.ajax({
                url: 'ajaxupload/upload_files',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(res) {
                    let result = JSON.parse(res);
                    if (window.location.pathname.indexOf('slider') >= 0 || window.location.pathname.indexOf('category') >= 0) {
                        $('#multiFiles').css({
                            'display': 'none'
                        });
                    }
                    var addUpdateProduct = $(".add-update-product").data("type");
                    let length = result.length;
                    for (let i = 0; i < length; i++) {
                        var html = "<div class ='item-images-upload'>" + "<div class='icon-delete'>" + "<span class ='fa fa-times-circle " + result[i].image + "'></span>" + "</div>" + "<img name = " + result[i].image + " src = " + 'assets/upload/' + result[i].image + ">" + "</div>"
                        $('.gallery').append(html);
                        if (addUpdateProduct && addUpdateProduct != undefined) {
                            var htmlAltTitleImage = "<div class='row' data-position=" + i + ">" + "<div class='form-group col-md-6'>" + "<label>Tiêu đề hình ảnh <span class = 'maudo'>(*)</span></label>" + "<input type='text' class='form-control' name='title_image[]' placeholder='Nhập tiêu đề hình ảnh' required>" + "</div>" + "<div class='form-group col-md-6'>" + "<label>Mô tả hình ảnh <span class = 'maudo'>(*)</span></label>" + "<input type='text' class='form-control' name='alt_image[]' placeholder='Nhập mô tả hình ảnh' required>" + "</div>" + "</div>";
                            $('#title-alt').append(htmlAltTitleImage);
                        }
                    }
                    let elts = document.getElementsByClassName('item-images-upload');
                    for (var i = 0; i < elts.length; ++i) {
                        $($(elts[i]).children()[0]).children()[0].onclick = markSelection;
                    }
                }
            })
        }
    });

    function markSelection(evt) {
        if (confirm('Bạn thực sự muốn xóa ảnh này ?')) {
            jQuery.ajax({
                url: 'ajaxupload/delete_file',
                type: 'POST',
                dataType: 'text',
                data: {
                    'img': evt.target.classList[2]
                },
                success: function(res) {
                    $('#multiFiles').css({
                        'display': 'block'
                    });
                    var addUpdateProduct = $(".add-update-product").data("type");
                    let elts = document.getElementsByClassName('item-images-upload');
                    for (var i = 0; i < elts.length; ++i) {
                        if ($($(elts[i]).children()[1]).context.name == evt.target.classList[2]) {
                            $($(elts[i]).children()[1]).parent().remove();
                            $("div[data-position='" + i + "']").remove();
                        }
                    }
                }
            })
        }
    }
    $('.button-add-cart').click(function(e) {
        e.preventDefault();
        var data = {
            id: $(this).data('id'),
            quantity: 1
        };
        var code = $('.info-item-product-active').data('position-div');
        if (code != undefined) {
            data.code = code;
        } else {
            data.code = null;
        }
        jQuery.ajax({
            url: $(this).data('url') + 'cart/addcart',
            type: "POST",
            dataType: "json",
            data,
            beforeSend: function() {},
            success: function(res) {
                let total = $('.total-product-cart').text();
                var count = 0;
                for (var k in res) {
                    if (res.hasOwnProperty(k)) {
                        ++count;
                    }
                };
                if (parseInt(total) < count) {
                    $('.total-product-cart').text(count);
                };
                $.toaster({
                    priority: "success",
                    title: "",
                    message: "Thêm sản phẩm vào giỏ hàng thành công"
                });
            }
        })
    });

    function isEmpty(obj) {
        if (obj == null) return true;
        if (obj.length > 0) return false;
        if (obj.length === 0) return true;
        if (typeof obj !== "object") return true;
        for (let key in obj) {
            if (obj[key].length != '') return false;
        }
        return true;
    }
    $('.quantity').change(function(e) {
        e.preventDefault();
        var data = $(this).data();
        if (!isEmpty(data)) {
            var sl = $(this).val();
            jQuery.ajax({
                url: data.url + 'cart/update',
                type: "POST",
                dataType: "json",
                data: {
                    id: data.id,
                    sl,
                    code: data.code
                },
                success: function(res) {
                    document.location.reload(!0);
                }
            });
        }
    });
    $('.remove').click(function(e) {
        e.preventDefault();
        var data = $(this).data();
        if (!isEmpty(data)) {
            if (confirm("Bạn thực sự muốn xóa sản phẩm này ?")) {
                jQuery.ajax({
                    url: data.url + 'cart/remove',
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: data.id,
                        code: data.code
                    },
                    success: function() {
                        document.location.reload(!0);
                    }
                })
            }
        }
    });
    $('#size').on('change', function() {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: $(this).data('url') + "product/change_price",
            data: {
                positionSize: $(this).val(),
                idProduct: $(this).data('product')
            },
            beforeSend: function() {
                $("#myDiv").show();
            },
            success: function(res) {
                if (res.code == 1) {
                    if (!res.data.isNotPrice) {
                        if (res.data.priceSale != '' && res.data.price != '') {
                            $('.price-sale').replaceWith(res.data.priceSale);
                            $('.price-default').replaceWith(res.data.price);
                            
                        } else if (res.data.priceSale != '' && res.data.price == '') {
                            $('.price-sale').replaceWith(res.data.priceSale);
                            $('.price-default').css({
                                display: 'none'
                            })
                         
                        } else if (res.data.price != '') {
                            $('.price-sale').replaceWith(res.data.price);
                            $('.price-default').css({
                                display: 'none'
                            })
                        }

                        if (res.data.sale != '') {
                            $('.sale-of').replaceWith(res.data.sale);
                            $('.sale-of').parent().css({
                                display: 'block'
                            });
                        }
                        $('.price-c').css({
                            display: 'block'
                        });
                        var display_button_add_cart = $('.button-add-cart').css('display');
                        var display_button_none = $('.button-none').css('display');
                        if (display_button_add_cart == 'none') {
                            $('.button-add-cart').css({
                                display: 'block'
                            });
                        }
                        if (display_button_none == 'block') {
                            $('.button-none').css({
                                display: 'none'
                            });
                        }
                    } else {
                        $('.price-c').css({
                            display: 'none'
                        });
                        $('.gia-thi-truong').css({
                            display: 'none'
                        });
                        $('.gia-thi-truong + span').css({
                            display: 'none'
                        });
                        var display_button_add_cart = $('.button-add-cart').css('display');
                        var display_button_none = $('.button-none').css('display');
                        if (display_button_add_cart == 'block') {
                            $('.button-add-cart').css({
                                display: 'none'
                            });
                        }
                        if (display_button_none == 'none') {
                            $('.button-none').css({
                                display: 'block'
                            });
                        }
                        if (res.data.prSale > 0) {
                            $('.sale-of').parent().css({
                                display: 'block'
                            });
                        } else {
                            $('.sale-of').parent().css({
                                display: 'none'
                            })
                        }
                    }
                    if (res.data.size != '') {
                        $('.size-select').replaceWith("<span class='size-select'>Kích thước: <b>" + res.data.size + "</b></span>");
                    } else {
                        $('.size-select').css({
                            display: 'none'
                        });
                    }
                    if (res.data.color != '') {
                        $('.color-select').replaceWith("<span class='color-select'>Màu sắc: <b>" + res.data.color + "</b></span>");
                    } else {
                        $('.color-select').css({
                            display: 'none'
                        });
                    }
                    if (res.data.weight != '') {
                        $('.weight-select').replaceWith("<span class='weight-select'>Khối lượng: <b>" + res.data.weight + "</b></span>");
                    } else {
                        $('.weight-select').css({
                            display: 'none'
                        });
                    }
                } else {
                    $.toaster({
                        priority: "error",
                        title: "",
                        message: "Thất bại, có lỗi xảy ra !"
                    });
                }
                $('#myDiv').hide();
            },
            error: function(err) {
                $.toaster({
                    priority: "warning",
                    title: "",
                    message: "Thất bại, có lỗi xảy ra !"
                });
                $("#myDiv").hide();
            }
        })
    });

    /*$('.file-up input').click(function() { console.log('Vo ham o uploadajax.js')
        var that = this;
        $(this).on('change', function() {
            let file = $(that)[0].files[0];
            var arrTypeFileAllow = ["image/jpeg", "image/png", "image/jpg"];
            if (!((file.type == arrTypeFileAllow[0]) || (file.type == arrTypeFileAllow[1]) || (file.type == arrTypeFileAllow[2]))) {
                alert('Chỉ được tải lên các định dạng đuôi: .jpg, .jpeg, .png');
            } else {
                readURL(file, that);
            }
        });
    });

    function readURL(file, el) {
        var reader = new FileReader();
        reader.onload = function(e) { 
            $($(el).parent()[0].children[0]).attr('src', e.target.result);
            $($(el).parent()[0]).append("<span class='fa fa-times-circle'><span>");
            let htmlAltTitleImageColors = "<div class='row' data-position-alt-title-image-color='0'>" + 
                "<div class='form-group col-md-6'>" + 
                    "<label>Tiêu đề hình ảnh <span class = 'maudo'>(*)</span></label>" + 
                    "<input type='text' class='form-control' name='item_title_image_color[]' placeholder='Nhập tiêu đề hình ảnh' required>" + 
                "</div>" + 
                "<div class='form-group col-md-6'>" + 
                    "<label>Mô tả hình ảnh <span class = 'maudo'>(*)</span></label>" + 
                    "<input type='text' class='form-control' name='item_alt_image_color[]' placeholder='Nhập mô tả hình ảnh' required>" + 
                "</div>" + 
            "</div>";
            $('#title-alt-img-color').append(htmlAltTitleImageColors);
            $(el).parent()[0].children[2].addEventListener('click', onClickIconDelete, false);
        }
        reader.readAsDataURL(file);
    }

    function onClickIconDelete() {
        console.log('Click delete')
        $(this).parent()[0].children[1].value = '';
        $(this).parent()[0].children[0].attributes[0].value = 'assets/images/icon_add.png';
        $(this).remove();
    }*/
});