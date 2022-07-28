(function(){
    const trList = document.querySelectorAll('tbody > tr'); //tr 배열이 넘어왔다.
    //dataset
    // 데이터를 받아올 부분에 data-이름 을 넣고
    // 받아서 넣을 부분에 dataset  
    trList.forEach((tr)=>{
        tr.addEventListener('click', () => {//list.php > tr data-iboard
            location.href = `detail?i_board=${tr.dataset.iboard}`
        })
    });

})();
