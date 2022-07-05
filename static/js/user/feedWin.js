const url = new URL(location.href);

function getFeedList() {
   
    if(!feedObj) { return; }
    feedObj.showLoading(); 

    const param = {
        page : feedObj.currentPage++,
        iuser : url.searchParams.get('iuser')
    }
    fetch('/user/feed' + encodeQueryString(param))
    .then(res => res.json())
    .then(list => {                
        feedObj.makeFeedList(list);                
    })
    .catch(e => {
        console.error(e);
        feedObj.hideLoading();
    });
}
getFeedList();

(function() {
    const lData = document.querySelector('#lData');
    const btnFollow = document.querySelectorAll('.btnFollow');
    btnFollow.forEach( btn => {
        btn.addEventListener('click', function() {
            const param = { toiuser : parseInt(lData.dataset.toiuser) };
            
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
                            if(btn.dataset.follower == "1") {
                                document.querySelector("#btnFollowToo").classList.remove("d-none");
                            } else {
                                document.querySelector("#btnFollow").classList.remove("d-none");
                            }
                        }
                    });
                    break;

                case '0': //팔로우 등록
                fetch(followUrl, { method: "POST",
                headers: { "Content-Type": "application/json"},  body: JSON.stringify(param),
                  })
                    .then((res) => res.json())
                    .then((res) => {
                      //   console.log(res);
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