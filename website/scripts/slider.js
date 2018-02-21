// Uses idealimageslider: http://idealimageslider.com/

$(document).ready(
    function () {
        var slider = new IdealImageSlider.Slider({
            selector: '#slider',
            maxHeight: 600
        });
        slider.start();
    }
);
