(function(){
    const btnDel = document.getElementById('btnDel');
    btnDel.addEventListener('click', ()=>{
        if(confirm("삭제하시겠습니까?")){
            location.href = `del?i_board=${btnDel.dataset.iboard}`
        }
    });
})();