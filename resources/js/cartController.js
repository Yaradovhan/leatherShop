$(function () {
    if ($('div').hasClass('main-cart-page')) {

        function onInit() {

            // var thisController = $(this),


            getItems();
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

        $('#removeAll').click(function () {
            var result = confirm('Очитстить корзину?');
            if (result) {
                var items = document.getElementsByClassName('cart-item');
                if (items.length > 0) {
                    var data = document.getElementById('cart_items'),
                        removeAllUrl = data.dataset.source;
                    axios
                        .delete(removeAllUrl)
                        .then(function (response) {
                            if (response.data === 1) {
                                for (var i = items.length - 1; i >= 0; --i) {
                                    items[i].remove();
                                }
                                getItems();
                            }
                        });
                }
            }
        });

        $('.removeItem').on('click', function () {
            var thisController = $(this),
                thisRow = thisController.parent().parent().parent(),
                removeUrl = thisController.data('source'),
                id = thisController.data('id');
            axios
                .delete(removeUrl, {
                    params: {
                        id: id
                    }
                }).then(function (response) {
                thisRow.remove();
                getItems();
            }).catch(function (error) {
                console.error(error);
            });

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

        function getItems() {
            var data = document.getElementById('main-cart'),
                allProdUrl = data.dataset.url,
                countItems = 0,
                remAllBtn = document.getElementById('removeAll');

            axios
                .get(allProdUrl)
                .then(function (response) {
                    countItems = Object.keys(response.data).length;
                    if (countItems === 0) {
                        let changeDiv = document.getElementById('cartItems'),
                            empty = '' +
                                '<div class="jumbotron jumbotron-fluid">' +
                                '<div class="container">' +
                                '<img src= "http://localhost:8000/storage/images/cart/empty.svg" class="rounded mx-auto d-block img-fluid" style="width: 10rem">' +
                                '<p class="text-center mt-2">Ваша корзина пуста</p>' +
                                '</div>' +
                                '</div>',
                        headerElem = document.createElement('div');
                        headerElem.innerHTML = empty;
                        // headerElem.textContent = 'Ваша корзина пустая';
                        changeDiv.replaceWith(headerElem);
                        remAllBtn.style.visibility = 'hidden';
                    }
                });
            getTotal();
        }

    }

});
