$(document).ready(function() {
    $("#typeCategory, #parentCategory").on("change", function() {
        var data = {
            typeCategory: $('#typeCategory').val() != '' ? parseInt($('#typeCategory').val()) : -2,
            parentCategory: $('#parentCategory').val() != '' ? parseInt($('#parentCategory').val()) : -2
        };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "admin/category/fillter",
            data,
            beforeSend: function() {
                $("#myDiv").show()
            },
            success: function(res) {
                $("#dataCategories").html(res);
                $("#myDiv").hide()
            },
            error: function(err) {
                $.toaster({
                    priority: "warning",
                    title: "",
                    message: "Thất bại, có lỗi xảy ra !"
                });
                $("#myDiv").hide()
            }
        })
    });

    $('.file-up input').click(function() { 
        let that = this;
        $(this).off('change').on('change', function() { 
            let file = $(that)[0].files[0];
            var arrTypeFileAllow = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
            if (!((file.type == arrTypeFileAllow[0]) || (file.type == arrTypeFileAllow[1]) || (file.type == arrTypeFileAllow[2]) || (file.type == arrTypeFileAllow[3]))) {
                alert('Chỉ được tải lên các định dạng đuôi: .jpg, .jpeg, .png');
            } else {
                readURLImageColor(
                    file, 
                    that, 
                    $(that).parent()[0].attributes['data-position-img-color'].value
                );
            }
        });
    });

    function readURLImageColor(file, el, positionAltTitleImageColor) { 
        /*if($($(el).parent()).data().changeImage && $($(el).parent()).data().changeImage == true) {
            $('div[data-position-alt-img-color="'+ $($(el).parent()).data().positionImgColor +'"]').css({
                display: 'block'
            });
        }*/
        var reader = new FileReader();
        reader.onload = function(e) {
            $($(el).parent()[0].children[0]).attr('src', e.target.result);
            $($(el).parent()[0]).append("<span class='fa fa-times-circle'><span>");
            $(el).parent()[0].children[2].addEventListener('click', function() {
                $(this).parent()[0].children[1].value = '';
                $(this).parent()[0].children[0].attributes[0].value = 'assets/images/icon_add.png';
                let positionAltTitleImageColor = $(this).parent()[0].attributes['data-position-img-color'].value;
                //$('div[data-position-alt-img-color="'+ positionAltTitleImageColor +'"]').remove();
                $(this).remove();
            }, false);
        }
        reader.readAsDataURL(file);
    }

    $('.button-add-option').on('click', function() {
        let listItemsFileUpload = document.getElementsByClassName('file-up');
        let positionImage = 0;
        for(let i = 0; i < listItemsFileUpload.length; i++) {
            if (listItemsFileUpload[i].dataset.positionImgColor) {
                if (parseInt(listItemsFileUpload[i].dataset.positionImgColor) > positionImage) {
                    positionImage = parseInt(listItemsFileUpload[i].dataset.positionImgColor);
                } else if(parseInt(listItemsFileUpload[i].dataset.positionImgColor) == positionImage) {
                    positionImage = parseInt(listItemsFileUpload[i].dataset.positionImgColor) + 1;
                }
            }
        }
        var html = '<tr>' + 
            '<td class="text-center">' + 
                '<input type="text" class="form-control" name="item_codes[]" placeholder="Nhập mã sản phẩm">' + 
            '</td>' + 
            '<td class="text-center">' + 
                '<input type="number" min="1000" step="500" class="form-control" name="item_prices[]" placeholder="Nhập giá sản phẩm">' + 
            '</td>' + 
            '<td class="text-center">' + 
                '<input type="number" min="1000" step="500" class="form-control" name="items_price_sale[]" placeholder="Nhập giá khuyến mãi">' + 
            '</td>' + 
            '<td class="text-center">' + 
                '<input type="text" class="form-control" name="item_sizes[]" placeholder="Nhập kích thước">' + 
            '</td>' + 
            '<td class="text-center" style="width: 90px;">' +
                '<div class="FileUpload">' +
                    '<div class="file-up" data-position-img-color="'+ positionImage +'">' +
                        '<img src="'+ $(this).data('url') +'assets/images/icon_add.png">' +
                        '<input type="file" name="item_colors[]" class="input-upload" accept="image/*" required>' +
                    '</div>' +
                '</div>' +
            '</td>' +
            '<td class="text-center">' + 
                '<input type="text" class="form-control" name="item_weights[]" placeholder="Nhập khối lượng">' + 
            '</td>' + 
            '<td>' +
                '<span class="fa fa-trash icon-remove-div" data-position-icon-remove="'+ positionImage +'" style="cursor: pointer;"></span>' +
            '</td>' +
        '</tr>';
        $('.table-options tbody').append(html);
        $('.file-up input')[positionImage].addEventListener('click', onClickUploadImage, false);
        $('.icon-remove-div')[positionImage].addEventListener('click', onRemoveDiv, false);
        //Add div title alt image for color
        let arrayElementsDataPositionImgColor = $('[data-position-alt-img-color]');
        let positionAltTitleImageColor = $($(arrayElementsDataPositionImgColor[arrayElementsDataPositionImgColor.length - 1])).data('positionAltImgColor') + 1;
        let htmlAltTitleImageColors = "<div class='row' data-position-alt-img-color="+ positionAltTitleImageColor +">" + 
            "<div class='form-group col-md-6'>" + 
                "<label>Tiêu đề hình ảnh "+ parseInt(positionAltTitleImageColor + 1) +"<span class = 'maudo'>(*)</span></label>" + 
                "<input type='text' class='form-control' name='item_title_image_color[]' placeholder='Nhập tiêu đề hình ảnh'>" + 
            "</div>" + 
            "<div class='form-group col-md-6'>" + 
                "<label>Mô tả hình ảnh "+ parseInt(positionAltTitleImageColor + 1) +"<span class = 'maudo'>(*)</span></label>" + 
                "<input type='text' class='form-control' name='item_alt_image_color[]' placeholder='Nhập mô tả hình ảnh'>" + 
            "</div>" + 
        "</div>";
        
        $('#title-alt-img-color').append(htmlAltTitleImageColors);
    });

    function onClickIconDelete(cb) {
        $(this).parent()[0].children[1].value = '';
        $(this).parent()[0].children[0].attributes[0].value = 'assets/images/icon_add.png';
        let positionAltTitleImageColor = $(this).parent()[0].attributes['data-position-img-color'].value;
        //$('div[data-position-alt-img-color="'+ positionAltTitleImageColor +'"]').remove();
        $(this).remove();
    }

    function onClickUploadImage() {
        let that = this;
        $(this).off('change').on('change', function() { 
            let file = $(that)[0].files[0];
            var arrTypeFileAllow = ["image/jpeg", "image/png", "image/jpg"];
            if (!((file.type == arrTypeFileAllow[0]) || (file.type == arrTypeFileAllow[1]) || (file.type == arrTypeFileAllow[2]))) {
                alert('Chỉ được tải lên các định dạng đuôi: .jpg, .jpeg, .png');
            } else {
                readURLImageColor(file, that, $(that).parent()[0].attributes['data-position-img-color'].value);
            }
        });
    }

    $('.file-up span').on('click', function(){
        let datas = ($(this).parent()).data();
        let that = this;
        if (datas.changeImage == true) {
            if (confirm('Thao tác này sẽ xóa ảnh ngay lập tức. Bạn thực hiện muốn xóa ảnh này ?')) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "admin/product/update_color",
                    data: {
                        positionImgColor: datas.positionImgColor,
                        idProduct: $('.form-update-product').data('product')
                    },
                    success: function(res) {
                        if (res.code == 1) {
                            $(that).parent()[0].children[1].value = '';
                            $($(that).parent()[0].children[1]).attr('required', 'required');
                            $(that).parent()[0].children[0].attributes[0].value = 'assets/images/icon_add.png';
                            let positionAltTitleImageColor = $(that).parent()[0].attributes['data-position-img-color'].value;
                            $(that).remove();
                        } else if (res.code == 2) {
                            $.toaster({
                                priority: "warning",
                                title: "",
                                message: "Thất bại! Sản phẩm không tồn tại hoặc đã bị xóa!"
                            });
                        }
                    },
                    error: function(err) {
                        $.toaster({
                            priority: "warning",
                            title: "",
                            message: "Thất bại, có lỗi xảy ra !"
                        });
                    }
                })
            }
        }/* else {
            $(this).parent()[0].children[1].value = '';
            $(this).parent()[0].children[0].attributes[0].value = 'assets/images/icon_add.png';
            let positionAltTitleImageColor = $(this).parent()[0].attributes['data-position-img-color'].value;
            $(this).remove();
        }*/
    });

    $('#is_product_video').on('change', function() {
        if ($('#is_product_video').is(':checked')) {
            $("#link_video").removeAttr('disabled');
            $('.file-up input').removeAttr('required');
        } else {
            $("#link_video").attr('disabled', 'disabled');
            $('.file-up input').attr('required', 'required');
        }
    });

    $('#category_id_post').on('change', function() {
        if ($(this).children('option:selected').data('type') == 6) {
            $("#urlVideo").removeAttr('disabled');
            $("#urlVideo").attr('required', 'required');
        } else {
            $("#urlVideo").attr('disabled', 'disabled');
            $("#urlVideo").removeAttr('required');
        }
    });

    $('.button-submit-product').on('submit', function(e) {
        if ($("select[name=category_id]").val() == -1) {
            $.toaster({
                priority: "warning",
                title: "",
                message: "Vui lòng chọn danh mục sản phẩm"
            });
            return false
        }
        if ($('#is_product_video').is(':checked')) {
            if ($("input[name=link_video]").val().length == '') {
                $.toaster({
                    priority: "warning",
                    title: "",
                    message: "Vui lòng nhập đường dẫn video"
                });
                return false
            }
        }
        var dataForm = $(this).serializeArray();
        var items_price_sale = [];
        var item_prices = [];
        for (var key in dataForm) {
            if (dataForm[key].name == 'items_price_sale[]') {
                items_price_sale.push(dataForm[key].value)
            }
            if (dataForm[key].name == 'item_prices[]') {
                item_prices.push(dataForm[key].value)
            }
        }
        var maxLength = Math.max(items_price_sale.length, item_prices.length);
        for (var i = 0; i < maxLength; i++) {
            if (items_price_sale[i] != '') {
                if (item_prices[i] == '') {
                    $.toaster({
                        priority: "warning",
                        title: "",
                        message: "Vui lòng nhập giá bán trước khi nhập giá khuyến mãi"
                    });
                    return false
                }
            }
            if (item_prices[i] != '') {
                if (parseInt(item_prices[i]) <= 0) {
                    $.toaster({
                        priority: "warning",
                        title: "",
                        message: "Giá gốc không hợp lệ"
                    });
                    return false
                }
            }
            if (items_price_sale[i] != '') {
                if (parseInt(items_price_sale[i]) <= 0 || parseInt(items_price_sale[i]) >= parseInt(item_prices[i])) {
                    $.toaster({
                        priority: "warning",
                        title: "",
                        message: "Giá khuyến mãi không hợp lệ"
                    });
                    return false
                }
            }
        }
        return true;
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

    $('.option').on('click', function(e) {
        var data = {
            idProduct: $(this).data("id"),
            optionName: e.target.name
        };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "admin/product/update_option",
            data,
            beforeSend: function() {
                $("#myDiv").show()
            },
            success: function(res) {
                if (res.code == 1) {
                    location.reload()
                } else {
                    $.toaster({
                        priority: "error",
                        title: "",
                        message: "Thất bại, có lỗi xảy ra !"
                    })
                }
                $('#myDiv').hide()
            },
            error: function(err) {
                $.toaster({
                    priority: "warning",
                    title: "",
                    message: "Thất bại, có lỗi xảy ra !"
                });
                $("#myDiv").hide()
            }
        })
    });

    $("#state").on("change", function() {
        var state = $(this).val();
        if (state != -1) {
            window.location.href = AlterQueryString('state', state)
        } else {
            window.location.href = location.origin + location.pathname
        }
    });

    $('.page').on('click', function(e) {
        e.preventDefault();
        if ($(this).attr('href') != undefined) {
            var page = $(this).data('page') - 1;
            var elementPre;
            if (page > 0) {
                elementPre = document.getElementById(page).parentElement
            } else {
                elementPre = document.getElementById(page + 1).parentElement
            }
            var elementNext = document.getElementById($(this).data('page')).parentElement;
            elementPre.classList.remove('active');
            elementNext.classList.add('active');
            window.location.href = AlterQueryString('page', page)
        }
    });

    function AlterQueryString(param, val) {
        var queryString = window.location.search.replace("?", "");
        var parameterListRaw = queryString == "" ? [] : queryString.split("&");
        var parameterList = {};
        for (var i = 0; i < parameterListRaw.length; i++) {
            var parameter = parameterListRaw[i].split("=");
            if (typeof val != 'undefined') {
                parameterList[parameter[0]] = parameter[1]
            } else if (param != parameter[0]) {
                parameterList[parameter[0]] = parameter[1]
            }
        }
        if (typeof val != 'undefined') {
            parameterList[param] = val
        }
        var newQueryString = Object.keys(parameterList).length > 0 ? "?" : "";
        for (var item in parameterList) {
            if (parameterList.hasOwnProperty(item)) {
                newQueryString += item + "=" + parameterList[item] + "&"
            }
        }
        newQueryString = newQueryString.replace(/&$/, "");
        return location.origin + location.pathname + newQueryString
    }

    $('#dateFrom').datepicker({
        format: 'yyyy-mm-dd',
        defaultViewDate: 'today',
        todayHighlight: true
    }).on("change", function() {
        var selected = $("#dateFrom input").val();
        if (selected == undefined || selected == '') {
            window.location.href = location.origin + location.pathname
        } else {
            window.location.href = AlterQueryString('from', selected)
        }
    });

    $('#dateTo').datepicker({
        format: 'yyyy-mm-dd',
        defaultViewDate: 'today',
        todayHighlight: true
    }).on("change", function() {
        var selected = $("#dateTo input").val();
        if (selected == undefined || selected == '') {
            window.location.href = location.origin + location.pathname
        } else {
            window.location.href = AlterQueryString('to', selected)
        }
    });
    $('.icon-remove-keyword').on('click', function() {
        $('input[name=keyword]').val('')
    });
    $(window).on('load', function() {
        if ($('input[name=keyword]').val() == "") {
            $(".icon-remove-keyword").attr('disabled', 'disabled')
        }
    });
    $('input[name=keyword]').on('change', function(e) {
        if ($('input[name=keyword]').val() == "") {
            $(".icon-remove-keyword").attr('disabled', 'disabled')
        } else {
            $(".icon-remove-keyword").removeAttr('disabled')
        }
    });
    $('input[name=keyword]').on('keydown', function(e) {
        if (e.which == 13) {
            e.preventDefault();
            window.location.href = AlterQueryString('keyword', $('input[name=keyword]').val())
        }
    });
    $(".icon-remove-keyword").on('click', function(e) {
        window.location.href = location.origin + location.pathname
    });
    $("#category").on("change", function() {
        var state = $(this).val();
        if (state != '') {
            window.location.href = AlterQueryString('cat', state)
        } else {
            window.location.href = location.origin + location.pathname
        }
    });
    $("#option").on("change", function() {
        var state = $(this).val();
        if (state != '') {
            window.location.href = AlterQueryString('option', state)
        } else {
            window.location.href = location.origin + location.pathname
        }
    });

    $('.button-zoom').on('click', function(e) {
        e.preventDefault();
        let htmlImage = "<img class='img-full-width' src="+ $(this).data('image') +" />";
        $('.modal-body').append(htmlImage);
        $('.modal-header').append('<h4 class="modal-title">'+ $(this).data('code') +'</h4>');
        $(".modal-view-product").modal();
    });

    $('.modal-view-product').on('hidden.bs.modal', function () {
        $('.modal-header h4').remove();
        $('.modal-body img').remove();
    });

    $('.info-item-product').on('click', function() {
        let positionSize = $(this).data('position-div');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: $('.button-zoom').data('url') + "product/change_price",
            data: {
                positionSize,
                idProduct: $('.button-zoom').data('product')
            },
            success: function(res) {
                if (res.code == 1) {
                    $('.info-item-product-active').removeClass('info-item-product-active');
                    $('div[data-position-div = '+ positionSize +']').addClass('info-item-product-active');
                    if (res.data.code == false) {
                        $('.code-select').css({
                            display: 'none'
                        });
                        $('.code-select').replaceWith("<span class='code-select'>Mã sản phẩm: <b>Đang cập nhật</b></span>");
                    } else {
                        $('.code-select').css({
                            display: 'block'
                        });
                        $('.code-select').replaceWith("<span class='code-select'>Mã sản phẩm: <b>"+ res.data.code +"</b></span>");
                    }
                    if (!res.data.isNotPrice || res.data.isNotPrice == false) {
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
                        } else {
                            $('.sale-of').parent().css({
                                display: 'none'
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
    
    function onRemoveDiv() {
        $($(this).parent().parent()).remove();
    }

    $('.button-add-elm').on('click', function() {
        let listItemsFileUpload = document.getElementsByClassName('file-up-2');
        let positionImage = 0;
        for(let i = 0; i < listItemsFileUpload.length; i++) {
            if (listItemsFileUpload[i].dataset.positionImg) {
                if (parseInt(listItemsFileUpload[i].dataset.positionImg) > positionImage) {
                    positionImage = parseInt(listItemsFileUpload[i].dataset.positionImg);
                } else if(parseInt(listItemsFileUpload[i].dataset.positionImg) == positionImage) {
                    positionImage = parseInt(listItemsFileUpload[i].dataset.positionImg) + 1;
                }
            }
        }
        let elm = '<div class="file-up-2" data-position-img="'+ positionImage +'">' +
            '<div>' +
                '<img src="'+ $(this).data('url') +'assets/images/icon_add.png">' +
                '<input type="file" name="images[]" class="input-upload" accept="image/*" required>' +
            '</div>' +
            '<a class="fa fa-trash button-remove-div-upload-image" data-position-icon-remove-div="'+ positionImage +'" href="javascript:void(0)" title="Xóa ảnh này"> Xóa</a>' +
        '</div>';
        $('.image-product').append(elm);
        
        //Add div title alt image for color
        let arrayElementsDataPositionImgColor = $('[data-position-alt-img]');
        let positionAltTitleImageColor = $($(arrayElementsDataPositionImgColor[arrayElementsDataPositionImgColor.length - 1])).data('positionAltImg') + 1;
        let htmlAltTitleImageColors = "<div class='row' data-position-alt-img="+ positionAltTitleImageColor +">" + 
            "<div class='form-group col-md-6'>" + 
                "<label>Tiêu đề hình ảnh <span class = 'maudo'>(*)</span></label>" + 
                "<input type='text' class='form-control' name='title_image[]' placeholder='Nhập tiêu đề hình ảnh' required>" + 
            "</div>" + 
            "<div class='form-group col-md-6'>" + 
                "<label>Mô tả hình ảnh <span class = 'maudo'>(*)</span></label>" + 
                "<input type='text' class='form-control' name='alt_image[]' placeholder='Nhập mô tả hình ảnh' required>" + 
            "</div>" + 
        "</div>";
        
        $('#title-alt').append(htmlAltTitleImageColors);
        $('.button-remove-div-upload-image')[positionImage].addEventListener('click', onClickRemoveDivFileUp, false);
        $('.file-up-2 input')[positionImage].addEventListener('click', onClickUploadImageProduct, false);
    });

    function onClickRemoveDivFileUp() {
        $(this).parent()[0].children[0].children[1].attributes[0].value = '';
        $(this).parent()[0].remove();
        let pos = parseInt($(this).parent()[0].dataset.positionImg);
        $('[data-position-alt-img='+ pos +']').remove()
    }

    $('.file-up-2 input').click(function() { 
        let that = this; 
        $(this).off('change').on('change', function() { 
            let file = $(that)[0].files[0];
            var arrTypeFileAllow = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
            if (!((file.type == arrTypeFileAllow[0]) || (file.type == arrTypeFileAllow[1]) || (file.type == arrTypeFileAllow[2]) || (file.type == arrTypeFileAllow[3]))) {
                alert('Chỉ được tải lên các định dạng đuôi: .jpg, .jpeg, .png');
            } else {
                readURLImage(
                    file, 
                    that
                );
            }
        });
    });

    function readURLImage(file, el) { 
        var reader = new FileReader();
        reader.onload = function(e) {
            $($(el).parent()[0].children[0]).attr('src', e.target.result);
            $($(el).parent()[0]).append("<span class='fa fa-times-circle'><span>");
            $(el).parent()[0].children[2].addEventListener('click', function() {
                $(this).parent()[0].children[1].value = '';
                $(this).parent()[0].children[0].attributes[0].value = 'assets/images/icon_add.png';
                $(this).remove();
            }, false);
        }
        reader.readAsDataURL(file);
    }

    function onClickUploadImageProduct() {
        let that = this;
        $(this).off('change').on('change', function() { 
            let file = $(that)[0].files[0];
            var arrTypeFileAllow = ["image/jpeg", "image/png", "image/jpg"];
            if (!((file.type == arrTypeFileAllow[0]) || (file.type == arrTypeFileAllow[1]) || (file.type == arrTypeFileAllow[2]))) {
                alert('Chỉ được tải lên các định dạng đuôi: .jpg, .jpeg, .png');
            } else {
                readURLImage(file, that);
            }
        });
    }

    $('.file-up-2 span').on('click', function(){
        let datas = ($(this).parent().parent()).data(); 
        let that = this;
        if (datas.changeImageProduct == true) {
            if (confirm('Thao tác này sẽ xóa ảnh ngay lập tức. Bạn thực hiện muốn xóa ảnh này ?')) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "admin/product/update_images_product",
                    data: {
                        positionImg: datas.positionImg,
                        idProduct: $('.form-update-product').data('product'),
                        type: 1
                    },
                    success: function(res) {
                        if (res.code == 1) {
                            $(that).parent()[0].children[1].value = '';
                            $($(that).parent()[0].children[1]).attr('required', 'required');
                            $(that).parent()[0].children[0].attributes[0].value = 'assets/images/icon_add.png';
                            $(that).remove();
                        } else if (res.code == 2) {
                            $.toaster({
                                priority: "warning",
                                title: "",
                                message: "Thất bại! Sản phẩm không tồn tại hoặc đã bị xóa!"
                            });
                        }
                    },
                    error: function(err) {
                        $.toaster({
                            priority: "warning",
                            title: "",
                            message: "Thất bại, có lỗi xảy ra !"
                        });
                    }
                })
            }
        }
    });

    $('.update-product-dp .button-remove-div-upload-image').on('click', function(){
        let datas = ($(this).parent()).data();
        let that = this;
        let isDisable = ($(this)).data('disabled');
        if (datas.changeImageProduct == true && (!isDisable || isDisable == false)) {
            if (confirm('Thao tác này sẽ xóa ảnh ngay lập tức. Bạn thực hiện muốn xóa ảnh này ?')) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "admin/product/update_images_product",
                    data: {
                        positionImg: datas.positionImg,
                        idProduct: $('.form-update-product').data('product'),
                        type: 2
                    },
                    success: function(res) {
                        if (res.code == 1) {
                            $(that).parent()[0].children[0].children[1].value = '';
                            $(that).parent()[0].children[0].children[0].attributes[0].value = 'assets/images/icon_add.png';
                            $($("div[data-position-alt-img]")[parseInt(datas.positionImg)]).remove();
                            $($(that).parent()[0]).remove();
                        } else if (res.code == 2) {
                            $.toaster({
                                priority: "warning",
                                title: "",
                                message: "Thất bại! Sản phẩm không tồn tại hoặc đã bị xóa!"
                            });
                        }
                    },
                    error: function(err) {
                        $.toaster({
                            priority: "warning",
                            title: "",
                            message: "Thất bại, có lỗi xảy ra !"
                        });
                    }
                })
            }
        }
    });
});