$(function () {
    if ($('div').hasClass('main-cart-page')) {

        function onInit() {

            // var thisController = $(this),
            //     data = document.getElementById('main-cart'),
            //     allProdUrl = data.dataset.url;
            //
            // axios
            //     .get(allProdUrl)
            //     .then(function (response) {
            //         localStorage.setItem('cart', JSON.stringify(response.data)) ;
            //     });
            getTotal();
            // console.log(JSON.parse(localStorage.getItem('cart')));
        }

        onInit();

        function getParent(thisController) {
            return thisController.parent().parent().parent().parent();
        }


        $('.plus-btn').on('click', function () {
            var thisController = $(this);
            var input = thisController.closest('div').find('input');
            var value = parseInt(input.val());
            var price = getParent(thisController).find('.price-col').text();

            if (value < 100) {
                value = value + 1;
            } else {
                value = 100;
            }
            input.val(value);
            setSum(getParent(thisController), price * value);
            getTotal();

        });

        $('.minus-btn').click(function () {
            var thisController = $(this);
            var input = thisController.closest('div').find('input');
            var value = parseInt(input.val());
            var price = getParent(thisController).find('.price-col').text();

            if (value > 1) {
                value = value - 1;
            } else {
                value = 1;
            }

            input.val(value);
            setSum(getParent(thisController), price * value);
            getTotal();

        });

        $('.removeAll').click(function () {
            var items = document.getElementsByClassName('cart-item');
            function f() {

            }
            // [].forEach.call(items, function(el) {
            //     console.log(el);
            //     // el.remove();
            // });
            // console.log()
        });

        function setSum(parent, sum) {
            var sumItem = parent.find('.sum');
            sumItem.val(sum);
        }

        function getTotal() {
            var total = 0;
            $('.sum').each(function () {
                total += parseInt(this.value);
            });
            $('#total').text(total);
        }

        function removeCurProd(thisController) {

        }

        function removeAllProd(thisController) {

        }

    }

});
