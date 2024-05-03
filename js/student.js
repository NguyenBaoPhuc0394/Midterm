const sidebar = document.querySelector("#toggle-btn")
const tooltips = document.querySelectorAll('.tooltip')
sidebar.addEventListener("click", function(){
    document.querySelector("#sidebar").classList.toggle("expand"); 
    tooltips.forEach(function(tooltip){
        if(document.querySelector("#sidebar").classList.contains("expand")){
            tooltip.style.display = "none";
        }
        else{
            tooltip.style.display = "inline-block";
        }
        // tooltip.toggle();
    })
});  

// const sidebarItem = document.querySelectorAll(".sidebar-item")
// const current_item = location.href;
// function active(event){
//     sidebarItem.forEach(item => {
//         item.classList.remove('active')
//     })
//     event.currentTarget.classList.add('active');
// }
// sidebarItem.forEach(item => {
//     item.addEventListener('click',active);
// })

// // const avatar = document.querySelector("#avatar")
// function home(event){
//     sidebarItem.forEach(item => {
//         item.classList.remove('active')
//     })
// }

