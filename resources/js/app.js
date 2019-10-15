import './bootstrap';
import './fotorama.js';

$('.product-slider').fotorama({
    shuffle: true,
    maxwidth: '100%',
    ratio: 16 / 9,
    allowfullscreen: true,
    nav: 'thumbs',
    loop: true
});

$(function() {
    $('.rating').barrating({
        theme: 'fontawesome-stars',
        onSelect: function(value, text, event) {
            var el = this;
            var el_id = el.$elem.data('id');
            var el_source = el.$elem.data('source');
            if (typeof(event) !== 'undefined') {
                var split_id = el_id.split("_");
                var postid = split_id[1];
                axios
                    .post(el_source, {params: {
                            postId: postid,
                            rating: value
                        }})
                    .then(function (response) {
                        var average = response.data['averageRating'];
                        $('#avgrating_'+postid).text(average.substr(0,3));
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            }
        }
    });
});
