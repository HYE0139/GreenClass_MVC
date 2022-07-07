
if(feedObj) {
    const url = new URL(location.href);
    feedObj.iuser = parseInt(url.searchParams.get('iuser'));
    feedObj.getFeedUrl = '/user/feed';
    feedObj.getFeedList();
}

(function() {
    const lData = document.querySelector('#lData');
    const btnFollow = document.querySelectorAll('.btnFollow');
    const btnDelCurrentProfilePic = document.querySelector('#btnDelCurrentProfilePic');
    const btnProfileImgModalClose = document.querySelector('#btnProfileImgModalClose');
    const btnProfileImgUp = document.querySelector('#btnProfileImgUp');

    btnFollow.forEach( btn => {
        btn.addEventListener('click', function() {
            const param = { toiuser : parseInt(lData.dataset.toiuser) };
            const follow = btn.dataset.follow;
            const followUrl = '/user/follow';
            const cntFollower = document.querySelector('#cntFollower');
            switch(follow) {
                case '1': //팔로우 취소
                    fetch(followUrl + encodeQueryString(param), {method: 'DELETE'})
                    .then(res => res.json())
                    .then(res => {
                        console.log(res);
                        if(res.result) {
                            //팔로워 숫자 변경
                            const cntFollowerVal = parseInt(cntFollower.innerText);
                            cntFollower.innerText = cntFollowerVal - 1;

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
                        //팔로워 숫자 변경
                        const cntFollowerVal = parseInt(cntFollower.innerText);
                        cntFollower.innerText = cntFollowerVal + 1;

                        btn.classList.add("d-none");
                        document.querySelector("#btnCancel").classList.remove("d-none");
                      }
                    });
                    break;
            }
        });
    });

    //프로필 사진 삭제 후 모달창 닫기
    if(btnDelCurrentProfilePic) {
        btnDelCurrentProfilePic.addEventListener('click', e=> {
            fetch('/user/profile', {method:'DELETE'})
            .then(res => res.json())
            .then(res => {
                if(res.result) {
                    const profileImgList = document.querySelectorAll('.delprofileImg');
                    profileImgList.forEach(item => {
                        item.src = '/static/img/profile/defaultProfileImg_100.png';
                    });
                }
                btnProfileImgModalClose.click();
            });
        });
    }

    // 프로필 사진 바꾸기 
    const profileModal = document.querySelector('#profileImgModal');
    const profileElem = profileModal.querySelector('form');


    if(btnProfileImgUp) {
        btnProfileImgUp.addEventListener('click', function(){
            profileElem.imgs.click(); // input.file 클릭

            profileElem.imgs.addEventListener('change', function(e) {
                const profileImgList = document.querySelectorAll('.delprofileImg');

                if(e.target.files.length > 0) {
                    const picRead = new FileReader();
                    picRead.readAsDataURL(e.target.files[0]);

                    picRead.onload = function(){

                        profileImgList.forEach((item)=> {
                            item.src = picRead.result;
                        });
                    }
                    const files = profileElem.imgs.files;
                    const picData = new FormData();
                    picData.append('imgs', files[0]);
                    console.log(files);
                   fetch('/user/profile', {
                    method : 'POST',
                    body : picData
                   }).then(res => res.json())
                     .then(myJson => {
                        if(myJson) {
                            btnProfileImgModalClose.click();       
                        }

                     })
                    
                }
            });
         
        });
    }

 
})();