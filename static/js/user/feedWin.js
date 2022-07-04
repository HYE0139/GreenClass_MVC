(function() {
    const gData = document.querySelector('#gData');
    const btnFollow = document.querySelectorAll('.btnFollow');
    btnFollow.forEach( btn => {
        btn.addEventListener('click', function() {
            const param = { toiuser : parseInt(gData.dataset.toiuser) };
            
            const follow = btn.dataset.follow;
            console.log('follow : ' + follow);
            const followUrl = '/user/follow';
            switch(follow) {
                case '1': //팔로우 취소
                    fetch(followUrl + encodeQueryString(param), {method: 'DELETE'})
                    .then(res => res.json())
                    .then(res => {
                        console.log(res);
                        if(res.result) {
                            btn.classList.add('d-none');
                            if(btn.dataset.follower === "1") {
                                document.querySelector("#btnFollowToo").classList.remove("d-none");
                            } else {
                                document.querySelector("#btnFollow").classList.remove("d-none");
                            }
                            
                        }
                    });
                    break;
                case '0': //팔로우 등록
                    fetch(followUrl, {method : 'POST', body : JSON.stringify(param)})
                    .then(res => res.json())
                    .then(res => {
                        if (res.result) {
                            btn.classList.add("d-none");
                            document.querySelector("#btnCancel").classList.remove("d-none");
                          }
            
                    });
                    break;
            }
        });
    });
 
})();