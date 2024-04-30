let copyTexts = document.querySelectorAll(".copy-text");

copyTexts.forEach(function(copyText) {
    let button = copyText.querySelector("button");
    button.addEventListener("click", function() {
        let input = copyText.querySelector("input.text");
        input.select();
        document.execCommand("copy");
        copyText.classList.add('active');
        window.getSelection().removeAllRanges();
        setTimeout(function() {
            copyText.classList.remove('active');
        }, 2500);
    });
});


const dropdown = document.querySelector('#dropdown');
const select = dropdown.querySelector('.select');
const caret = dropdown.querySelector('.caret');
const menu = dropdown.querySelector('.menu');
const options = dropdown.querySelectorAll('.menu li');
const selected = dropdown.querySelector('.selected');
var monhoc;
select.addEventListener('click', () => {
    select.classList.toggle('select-clicked');
    caret.classList.toggle('caret-rotate');
    menu.classList.toggle('menu-open');
});
options.forEach(option => {
    option.addEventListener('click', ()=>{
        selected.innerText = option.innerText;
        monhoc = selected.innerText;
        select.classList.remove('select-clicked');
        caret.classList.remove('caret-rotate');
        menu.classList.remove('menu-open');
        options.forEach(option => {
            option.classList.remove('act');
        });
        option.classList.add('act');
        showLink(monhoc);
    });
});
document.addEventListener('click', function(event) {
    if (!dropdown.contains(event.target)) {
        select.classList.remove('select-clicked');
        caret.classList.remove('caret-rotate');
        menu.classList.remove('menu-open');
    }
});

function showLink(monhoc){
    if(monhoc == '' || monhoc == 'Chọn môn học'){
        return;
    }else{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "../Controller/getElearning.php", true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let dataResponse = this.responseText;
                let dataArray = JSON.parse(dataResponse);
                let bg = document.querySelector("#linkBG");
                let onl = document.querySelector("#linkOnl");
                bg.value = dataArray[0];
                onl.value = dataArray[1];
                // console.log(dataResponse);
                // let bg = document.querySelector("#linkBG");
                // bg.value = dataResponse;
            }
        };
        xmlhttp.send("selectedValue=" + encodeURIComponent(monhoc));
    }
}



