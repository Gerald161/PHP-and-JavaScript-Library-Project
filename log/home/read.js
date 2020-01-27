var slider = document.querySelector('.read-flex');
var next = document.querySelector('.next');
var prev = document.querySelector('.prev');
var counter = 0;

const sliders = Array.from(slider.querySelectorAll('.img'));
let lastSlider = sliders[sliders.length - 1];

sliders.forEach(slide => {
    slide.dataset.left = "-100";
});

sliders[0].dataset.left = "0";

var stuff = [];

for(var i = 0; i < sliders.length; i++){
    stuff.push(sliders[i].dataset.left)
}

var c = stuff.join('+');

const final = eval(c);

next.addEventListener('click', ()=>{
    slider.style.transition = 'all 0.7s';
    if(counter == final){
        slider.animate([{opacity:'0.2'},{opacity:"1.0"}],{duration:500,fill:'forwards'});
        counter = 100;
        slider.style.transition = 'all 0s';
    }
    counter -= 100;
    slider.style.left = counter + 'vw';
})

prev.addEventListener('click', ()=>{
    slider.style.transition = 'all 0.7s';
    if(counter == 0){
        slider.animate([{opacity:'0.2'},{opacity:"1.0"}],{duration:500,fill:'forwards'});
        counter = final-100;
        slider.style.transition = 'all 0s';
    }
    counter += 100;
    slider.style.left = counter + 'vw';
})