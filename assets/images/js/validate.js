$(document).ready(function() {
    $('#submit-form-update').click(function(evt) {
        if ($("input[name=birthday]").val() != '') {
            let valueBirthday = $("input[name=birthday]").val();
            if (moment().diff(moment(valueBirthday, 'YYYY/MM/DD'), 'years') >= 10) {
                $('.error-birthday').css({
                    display: 'none'
                });
                return true
            } else {
                $('.error-birthday').css({
                    display: 'block'
                });
                return false
            }
        } else {
            return true
        }
    });
    $('#button-cancel-order').click(function(e) {
        return confirm('Bạn thực sự muốn hủy đơn hàng này?')
    })
});

function renderImages(arrayImages, idProduct) {
    var listImagesProduct = document.getElementById('list-gallery');
    var html = "";
    for (var i in arrayImages) {
        html += "<div class='item-images-upload render'>";
        html += "<div class='icon-delete'>";
        html += "<span class ='fa fa-times-circle " + arrayImages[i] + ' ' + idProduct + "'></span>";
        html += "</div>";
        html += "<img name=" + arrayImages[i] + " src=assets/upload/" + arrayImages[i] + ">";
        html += "</div>"
    }
    $(document).ready(function() {
        let elts = document.getElementsByClassName('item-images-upload');
        for (var i = 0; i < elts.length; ++i) {
            $($(elts[i]).children()[0]).children()[0].onclick = deleteImage
        }
    });
    listImagesProduct.innerHTML = html
};

function deleteImage(evt) {
    if (confirm('Hình ảnh sẽ không thể khôi phục sau khi xóa. Bạn thực sự muốn xóa ảnh này ?')) {
        jQuery.ajax({
            url: 'ajaxupload/delete_image_product',
            type: 'POST',
            dataType: 'text',
            data: {
                img: evt.target.classList[2],
                idProduct: evt.target.classList[3]
            },
            success: function(res) {
                res = JSON.parse(res);
                var addUpdateProduct = $(".add-update-product").data("type");
                if (res.code == 1) {
                    $('#multiFiles').css({
                        'display': 'block'
                    });
                    let elts = document.getElementsByClassName('item-images-upload');
                    for (var i = 0; i < elts.length; ++i) {
                        if ($($(elts[i]).children()[1]).context.name == evt.target.classList[2]) {
                            $($(elts[i]).children()[1]).parent().remove();
                            if (addUpdateProduct && addUpdateProduct != undefined) {
                                $("div[data-position='" + i + "']").remove()
                            }
                        }
                    }
                }
            },
            error: function(err) {
                console.log(err)
            }
        })
    }
}