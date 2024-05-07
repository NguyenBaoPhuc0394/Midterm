
const dropdown = document.querySelector('#dropdown');
const select = dropdown.querySelector('.select');
const menu = dropdown.querySelector('#dropdown-menu');
const options = dropdown.querySelectorAll('#dropdown-menu li');
const selected = dropdown.querySelector('.selected');
const rows = document.querySelectorAll(".teacher");
const search = document.querySelector(".search-input");
var tbody = document.querySelector('tbody');
// const rows = tbody.querySelectorAll(".teacher");
var monhoc;

select.addEventListener('click', () => {
    select.classList.toggle('select-clicked');
    menu.classList.toggle('menu-open');
});
options.forEach(option => {
    option.addEventListener('click', ()=>{
        selected.innerText = option.innerText;
        monhoc = selected.innerText;
        select.classList.remove('select-clicked');
        menu.classList.remove('menu-open');
        options.forEach(option => {
            option.classList.remove('act');
        });
        option.classList.add('act');
        showTeachers(monhoc)
    });
});

// function showInfor(monhoc){
//     search.value = "";
//     if(monhoc !== "Choose Subject"){
//         rows.forEach(row => {
//             const subjectCell = row.querySelector(".tenmon");
//             const subject = subjectCell.textContent.trim();
//             if (subject.toLowerCase() !== monhoc.toLowerCase()) {
//                 row.style.display = "none";
//             } 
//             else{
//                 row.style.display = "";
//             }
//         });
//     }
//     else{
//         rows.forEach(row =>{
//             row.style.display = "";
//         })
//     }
// }

search.addEventListener("input",showName);
function showName(){
    const rows = document.querySelectorAll(".teacher");
    const text = search.value;
    rows.forEach(row => {
        const subjectCell = row.querySelector(".hoten");
        const subject = subjectCell.textContent.trim();
        if (!subject.toLowerCase().includes(text.toLowerCase())) {
            row.style.display = "none";
        } 
        else{
            row.style.display = "";
        }
    });
}


function showTeachers(monhoc){
    search.value = "";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "Controller/getTeacher.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let dataResponse = this.responseText;
            let dataArrays = JSON.parse(dataResponse);
            while (tbody.firstChild) {
                tbody.removeChild(tbody.firstChild);
            }
            dataArrays.forEach(function(dataArray){
                var newRowHTML = '<tr class="teacher">' +
                                '<td class="magv">' + dataArray['magv'] + '</td>' +
                                '<td class="hoten">' + dataArray['hoten'] + '</td>' +
                                '<td class="tenmon">' + dataArray['tenmon'] + '</td>' +
                                '<td class="sdt">' + dataArray['sdt'] + '</td>' +
                                '</tr>';
                tbody.innerHTML += newRowHTML;
            })
            const rows = document.querySelectorAll(".teacher");
        }
    };
    xmlhttp.send("subject=" + encodeURIComponent(monhoc));
}
