var html=document.querySelector("html");var timer;function changeRem(){var width=html.getBoundingClientRect().width;html.style.fontSize=width/25+"px"}function Time(){clearTimeout(timer);timer=setTimeout(function(){changeRem()},200)}window.addEventListener("resize",function(){Time()});window.addEventListener("pageshow",function(e){if(e.persisted){Time()}});