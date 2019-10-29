import './bootstrap';
import './fotorama.js';
import './cartController.js'

$(function () {

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
            }).then(function (response) {
            var button = document.createElement('button');
            button.type = "button";
            button.textContent = 'Added to cart';
            button.setAttribute("class", "btn btn-sm btn-outline-secondary btn-buy ml-5");
            button.disabled = true;
            thisContcroller.replaceWith(button);
        }).catch(function (error) {
            console.error(error);
        });
    });


});
