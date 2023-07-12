// If page has class then run script
$(function() {

    if ($('main').is('.enableCount')) {
        var max = 300;
        var text = document.getElementById('message');
        var remainder = document.getElementById('remainder');

        remainder.textContent = max - text.value.length;

        text.addEventListener('input', function () {
            remainder.textContent = max - this.value.length;
        });
    }
});
