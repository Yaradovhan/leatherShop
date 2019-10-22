import './bootstrap';
import './fotorama.js';

$(function () {
    $('.product-slider').fotorama({
        shuffle: true,
        maxwidth: '100%',
        ratio: 16 / 9,
        nav: 'thumbs',
        loop: true,
        allowfullscreen: 'native'
    });
});

$(function () {
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
});

$(function () {
    $('.main_rating').barrating({
        theme: 'fontawesome-stars-o',
        allowEmpty: true,
        emptyValue: '0'
    });
});

$(function () {
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
});


$(function () {
    $('.btn-buy').click(function () {
        var data = $(this).data(),
            url = data.source;
        axios({
            method: 'put',
            url: url
        }).then(function (response) {
            console.log(response);
        }).catch(function (error) {
            console.error(error);
        });

    })
})



