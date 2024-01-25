
// Run code js
function runCodeJs(){

    ckediter();
    
}

runCodeJs();




// ckediter

function ckediter(){

let allCkediter = document.querySelectorAll('.ckediter');

if(allCkediter != null){
    allCkediter.forEach((item, index) => { 
        item.id = 'ckediter_'+index;
        CKEDITOR.replace(item.id);
    });
}

}