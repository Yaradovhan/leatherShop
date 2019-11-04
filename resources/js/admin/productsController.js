$(function () {


$('.setActivityBtn').click(function (e) {

var thisController = $(this),
    thisId = thisController.data('id');
console.log(thisController.data('id'));
    e.preventDefault();

});

});
