import './bootstrap';
import './fotorama.js';
import './cartController.js';
import './bootstrap-notify';
import './admin/productsController';

$(document).ready(function () {

    $('#summernote').summernote({
        callbacks: {
            onImageUpload: function (files) {
                var editor = $(this),
                    url = editor.data('image-url'),
                    data = new FormData();
                data.append('file', files[0]);
                axios
                    .post(url, data).then(function (response) {
                    editor.summernote('insertImage', response.data)
                        .catch(function (response) {
                            console.log(response)
                        })
                })
            }
        }
    });

    $('.product-slider').fotorama({
        shuffle: true,
        maxwidth: '100%',
        ratio: 16 / 9,
        nav: 'thumbs',
        loop: true,
        allowfullscreen: 'native'
    });


    $('.rating').barrating({
        theme: 'fontawesome-stars',
        allowEmpty: true,
        emptyValue: '0',
        onSelect: function (value, text, event) {
            var el = this;
            var el_id = el.$elem.data('id');
            var el_source = el.$elem.data('source');
            if (typeof (event) !== 'undefined') {
                var split_id = el_id.split("_");
                var postid = split_id[1];
                axios
                    .post(el_source, {
                        params: {
                            postId: postid,
                            rating: value
                        }
                    })
                    .then(function (response) {
                        var average = response.data['averageRating'];
                        $('#avgrating_' + postid).text(average.substr(0, 3));
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            }
        }
    });

    $('.main_rating').barrating({
        theme: 'fontawesome-stars-o',
        allowEmpty: true,
        emptyValue: '0'
    });

    $('.favme').click(function () {
        var data = $(this).data(),
            url = data.source,
            active = $(this).hasClass("active"),
            typeHttp = active ? "delete" : "post";
        axios({
            method: typeHttp,
            url: url
        }).catch(function (error) {
            console.error(error);
        });
        $(this).toggleClass('active');
    });


    $('.btn-buy').click(function () {
        var thisContcroller = $(this),
            data = thisContcroller.data(),
            url = data.source,
            name = data.name,
            id = data.id;
        axios
            .put(url, {
                params: {
                    id: id,
                    name: name
                }
            }).then(function (res) {
            thisContcroller.text('Added to cart');
            thisContcroller.removeClass("btn-outline-primary btn-primary");
            thisContcroller.addClass("btn-outline-secondary");
            thisContcroller.prop('disabled', true);
            $.notify({
                message: res.data.name + ' added to your cart'
            },{
                type: 'minimalist',
                delay: 1000,
                icon_type: 'image',
                template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                    '<span data-notify="message">{2}</span>' +
                    '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                    '</div>'
            });
        });
    });

    $('#newPageBtn').click(function (e) {
        e.preventDefault();
        var url = $(this).data('new-page');
        location.assign(url);
    });

    $('#createSlugBtn').click(function (e) {
        e.preventDefault();
        var slugify = require('slugify/slugify'),
            title = document.getElementById('title').value,
            slug = document.getElementById('slug');
        slug.value = slugify(title, '_');
    })

});
