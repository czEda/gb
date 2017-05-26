var form = $('#form');

form.submit(function(event) {

    event.preventDefault();

    var submitButton = $('#form-action');

    var name = $('#form-name');
    var email = $('#form-email');
    var text = $('#form-text');

    if(name.val() != "" && email.val() != "" && text.val() != "") {

        var $form = $(event.target);

        submitButton.html('Odesílání <i class="fa fa-cog fa-spin"></i>');
        submitButton.attr('disabled', 'disable');
        submitButton.css('background-color', 'gray');

        $.post("/", $form.serialize()).done(function(Data) {
            submitButton.html('Odesláno <i class="fa fa-check"></i>');
            submitButton.css('background-color', '#0b97c4');

            if(Data != "ok") {
                alert(Data);
            }

            setTimeout(function() {
                name.val("");
                email.val("");
                text.val("");

                submitButton.removeAttr('disabled');
                submitButton.html('Odeslat <i class="fa fa-arrow-circle-right"></i>');
            }, 600);

        });
    } else {
        alert('Vyplňte prosím všechna pole!');
    }

});

var Sockets = io.connect('localhost:4000');
var messages = $('.messages');

Sockets.on('Messages', function(data) {

    messages.prepend('<div class="message hide"> <h2 class="message-name">'+ data.name +'</h2> <div class="message-text">'+ data.text +' </div> <div class="message-email">'+ data.email +'</div> <div class="message-date">'+ data.date +'</div> </div>');

    $('.hide').slideDown();

});
