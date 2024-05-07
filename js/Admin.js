const hamburger = document.querySelector("#toggle-btn");

hamburger.addEventListener("click", function(){
    document.querySelector("#sidebar").classList.toggle("expand");  // xử lý sự kiện khi click btn toggle
});  

