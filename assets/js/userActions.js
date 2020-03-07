function subscribe(userTo, userFrom, button) {

    if (userTo == userFrom) {
        alert("You can't subscribe to yourself.");
        return;
}

$.post("ajax/subscribe.php", { userTo: userTo, userFrom: userFrom })
.done(function(count) {
    
    if (count != null) {
        $(button).toggleClass("subscribe unsubscribe");
        //toggle between subbed and unsubbed (red vs. grey button + count) when click sub button
        var buttonText = $(button).hasClass("subscribe") ? "SUBSCRIBE" : "SUBSCRIBED";
        $(button).text(buttonText + " " + count)
    }
    else {
        alert("something went wrong");
    }
});

}