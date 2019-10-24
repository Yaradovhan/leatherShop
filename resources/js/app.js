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
        var data = $(this).data(),
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
            console.log(response);
        }).catch(function (error) {
            console.error(error);
        });

    });

    // $('.minus-btn').on('click', function (e) {
    //     e.preventDefault();
    //     var $this = $(this);
    //     var $input = $this.closest('div').find('input');
    //     var value = parseInt($input.val());
    //
    //     if (value > 1) {
    //         value = value - 1;
    //     } else {
    //         value = 1;
    //     }
    //
    //     $input.val(value);
    //
    // });

    $('.plus-btn').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        var input = $this.closest('div').find('input');
        var value = parseInt(input.val());

        if (value < 100) {
            value = value + 1;
        } else {
            value = 100;
        }

        input.val(value);
    });

    // $('.cart-item').on('click', function (evt) {
    //     var elem = evt.target;
    //     var container = evt.currentTarget;
    //     // console.log(container);
    //     var input = container.getElementsByClassName('counter')[0];
    //     // console.log(input);
    //     var sum = container.getElementsByClassName('sum')[0];
    //     var count = parseInt(input.getAttribute('data-count'), 10);
    //     // console.log(count)
    //     var price = parseInt(input.getAttribute('data-price'), 10);
    //     //
    //     if (elem.classList.contains('minus-btn')) {
    //         count = count == 1 ? count : (count - 1);
    //     } else if (elem.classList.contains('plus-btn')){
    //         count += 1;
    //     }
    //     console.log(count);
    //     // console.log(count)
    //     input.value = count;
    //     // sum.innerHTML = price * count;
    //     // input.setAttribute('data-count', count);
    // });

    $('.minus-btn').click(function () {
        // e.preventDefault();
        var $this = $(this);
        var input = $this.closest('div').find('input');
        console.log(input);
        var value = parseInt(input.val());
        var price = $(this).parent().parent().parent().parent().find('.price-col').text();
        var thisParent = $(this).parent().parent().parent().parent();

        console.log(parseInt(thisParent.closest('div').find('.sum').val()));

        if (value > 1) {
            value = value - 1;
        } else {
            value = 1;
        }

        input.val(value);

        // console.log($(this).parent().parent().parent().parent().find('.price-col').text());

        // console.log( parseInt($(this).next().val()) +  parseInt( $(this).parent().parent().parent().find('.price-col').text()) );
    });

    // document.getElementById('cart_items').addEventListener('click', function (e) {
    //     e.preventDefault();
    //     var $this = $(this),
    //         input = $this.closest('div').find('input'),
    //         value = parseInt(input.val());
    //     console.log($this.children());
    // })
});
