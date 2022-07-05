const feedObj = {
    limit : 20,
    itemLength : 0,
    currentPage : 1,
    swiper : null,
    loadingElem : document.querySelector('.loading'),
    containerElem : document.querySelector('#item_container'),

    refreshSwipe: function() {
        if(this.swiper !== null) { this.swiper = null; }
        this.swiper = new Swiper('.swiper', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            pagination: { el: '.swiper-pagination' },
            allowTouchMove: false,
            direction: 'horizontal',
            loop: false
        });
    },

    loadingElem: document.querySelector('.loading'),
    containerElem: document.querySelector('#item_container'),  
    
    getFeedCmtList : function(ifeed, divCmtList, spanMoreCmt){
        fetch(`/feedCmt/index?ifeed=${ifeed}`)
        .then(res =>res.json())
        .then(res => { 
            if(res && res.length > 0) { // 문자열이 0 이상이 되면
                if(spanMoreCmt) { spanMoreCmt.remove(); }
                divCmtList.innerHTML = null;
                res.forEach(item => {
                    const divCmtItem = this.makeCmtItem(item);
                    divCmtList.appendChild(divCmtItem);
                });
            }
        });
    },

    // 피드 영역에 댓글 보이기
    makeCmtItem : function(item) {
        const divCmtItemContainer = document.createElement('div');
        divCmtItemContainer.className = 'd-flex flex-row align-items-center mb-2';
        const src = '/static/img/profile/' + (item.writerimg ? `${item.iuser}/${item.writerimg}` : 'defaultProfileImg_100.png');
        divCmtItemContainer.innerHTML = `
            <div class="circleimg h24 w24 me-1">
                <img src="${src}" class="profile pointer">
            </div>
            <div class="d-flex flex-row">
                <div class="pointer me-2 bold">${item.writer} <span class="rem0_5 fc-g ">${getDateTimeInfo(item.regdt)}</span></div>
                <div>${item.cmt}</div>
            </div>
        `;
        const img = divCmtItemContainer.querySelector('img');
        img.addEventListener('click', e => {
            moveToFeedWin(item.iuser);
        });
        
        return divCmtItemContainer;
    },

    

    // feed contents list
    // getFeedList로 받아온 feed를 리스트 형식으로
    makeFeedList: function(list) {
        if(list.length !== 0) {
            list.forEach(item => {
                const divItem = this.makeFeedItem(item);
                this.containerElem.appendChild(divItem);
            });
        }
        // 피드 이미지 슬라이드
        this.refreshSwipe();
        this.hideLoading();
    },  


    // feed contents
    makeFeedItem : function(item) {
        console.log(item);
        const divContainer = document.createElement('div');
        divContainer.className = 'item mt-3 mb-3';

        const divTop = document.createElement('div');
        divContainer.appendChild(divTop);

        const regDtInfo = getDateTimeInfo(item.regdt);
        divTop.className = 'd-flex flex-row ps-3 pe-3';
        const writerImg = `<img src='/static/img/profile/${item.iuser}/${item.mainimg}' onerror='this.error=null; this.src="/static/img/profile/defaultProfileImg_100.png"'>`;
        divTop.innerHTML = `
            <div class="d-flex flex-column justify-content-center">
                <div class="circleimg h40 w40 pointer feedWin">${writerImg}</div>
            </div>
            <div class="p-3 flex-grow-1">
                <div><span class="pointer feedWin">${item.writer}</span>  <span class="fc-g rem0_7">${regDtInfo}</span></div>
                <div class="fc-g rem0_8">${item.location === null ? '' : item.location}</div>
            </div>
        `;
        const feedWinList = divTop.querySelectorAll('.feedWin');
        feedWinList.forEach(el => {
            el.addEventListener('click', () => {
                moveToFeedWin(item.iuser);
            });
        })

        const divImgSwiper = document.createElement('div');
        divContainer.appendChild(divImgSwiper);
        divImgSwiper.className = "swiper item_img ";
        divImgSwiper.innerHTML = `
            <div class="swiper-wrapper align-items-center mh_600"></div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"><img src="/static/svg/leftArrow.svg"></div>
            <div class="swiper-button-next"><img src="/static/svg/rightArrow.svg"></div>
        `;
        
        const divSwiperWrapper = divImgSwiper.querySelector('.swiper-wrapper');
        //여러장의 이미지를 불러올 수 있도록 반복문
        item.imgList.forEach(function(imgObj) {
            const divSwiperSlide = document.createElement('div');
            divSwiperWrapper.appendChild(divSwiperSlide);
            divSwiperSlide.classList.add('swiper-slide');

            const img = document.createElement('img');
            divSwiperSlide.appendChild(img);
            img.className = 'w100p_mw614';
            img.src = `/static/img/feed/${item.ifeed}/${imgObj.img}`;
        });
        
        // -------------- 좋아요 버튼 ----------------
        const divBtns = document.createElement('div');
        divContainer.appendChild(divBtns);
        divBtns.className = 'favCont p-3 d-flex flex-row';

        const heartIcon = document.createElement('i');
        divBtns.appendChild(heartIcon);
        heartIcon.className = 'fa-heart pointer rem1_5 me-3';
        heartIcon.classList.add(item.isFav === 1 ? 'fas' : 'far');
        heartIcon.addEventListener('click', e => {

            let method = 'POST';
            if(item.isFav === 1) { //delete (1은 0으로)
                method = 'DELETE';
            }

            fetch(`/feed/fav/${item.ifeed}`, {
                'method' : method,
            }).then(res => res.json())
            .then(res => {
                if(res.result) {
                    item.isFav = 1 - item.isFav;
                    if(item.isFav === 0) {//좋아요 취소
                        heartIcon.classList.remove('fas');
                        heartIcon.classList.add('far');
                    } else { // 좋아요
                        heartIcon.classList.remove('far');
                        heartIcon.classList.add('fas');
                    }
                } else {
                    alert('요청이 거부되었습니다.');
                }
            })
            .catch( e => {
                alert('네트워크에 이상이 있습니다.');
            });
        });

        const divDm = document.createElement('div');
        divBtns.appendChild(divDm);
        divDm.className = 'pointer';
        divDm.innerHTML = `<svg aria-label="다이렉트 메세지" class="_8-yf5 " color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 24 24" width="24"><line fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2" x1="22" x2="9.218" y1="3" y2="10.083"></line><polygon fill="none" points="11.698 20.334 22 3.001 2 3.001 9.218 10.084 11.698 20.334" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></polygon></svg>`;

        const divFav = document.createElement('div');
        divContainer.appendChild(divFav);
        divFav.className = 'p-3 d-none';
        const spanFavCnt = document.createElement('span');
        divFav.appendChild(spanFavCnt);

        spanFavCnt.className = 'fc-g';
        spanFavCnt.innerHTML = `좋아요 ${item.favCnt}개`;

        // 좋아요가 0개면 문구가 안보이게
        if( item.favCnt > 0 ) { divFav.classList.remove('d-none'); }

        //feed Text 내용
        if( item.ctnt !== null && item.ctnt !== '' ) {
            const divCtnt = document.createElement('div');
            divContainer.appendChild(divCtnt);
            divCtnt.innerText = item.ctnt;
            divCtnt.className = 'itemCtnt p-3';
        }

        // -----------------댓글----------------------
        const divCmtList = document.createElement('div');
        divContainer.appendChild(divCmtList);
        divCmtList.className = 'ms-3';

        const divCmt = document.createElement('div');
        divContainer.appendChild(divCmt);


        const spanMoreCmt = document.createElement('span');
        if(item.cmt) {
            const divCmtItem = this.makeCmtItem(item.cmt);
            divCmtList.appendChild(divCmtItem);

            if( item.cmt.ismore === 1 ) {
                const divMoreCmt = document.createElement('div');
                divCmt.appendChild(divMoreCmt);
                divMoreCmt.className = 'ms-3 mb-3';

                divMoreCmt.appendChild(spanMoreCmt);
                spanMoreCmt.className = 'pointer rem0_9 c_lightgray';
                spanMoreCmt.innerText = '더보기...';

                spanMoreCmt.addEventListener('click', e => {
                    this.getFeedCmtList(item.ifeed, divCmtList, spanMoreCmt);
                });
            }
        }



        const divCmtForm = document.createElement('div');
        divCmtForm.className = 'd-flex flex-row';
        divCmt.appendChild(divCmtForm);

        divCmtForm.innerHTML = `
            <input type="text" class="flex-grow-1 my_input back_color p-2" placeholder="댓글을 입력하세요...">
            <button type="button" class="btn btn-outline-primary">게시</button>
        `;

        const inputCmt = divCmtForm.querySelector('input');
        const btnCmtReg = divCmtForm.querySelector('button');

        // 댓글 작성시, enter 누르면 이벤트 함수, click 실행
        inputCmt.addEventListener('keyup', e => {
            if(e.key === 'Enter') {
                btnCmtReg.click();
            }
        });

        btnCmtReg.addEventListener('click', e => {
            const param = {
                ifeed : item.ifeed,
                cmt : inputCmt.value
            };
            // 댓글 보내기
            fetch('/feedCmt/index', {
                method : 'POST',
                body : JSON.stringify(param)
                // JSON.stringify() : JSON 문자열로 변환
            })
            .then(res=> res.json())
            .then(res=> {
                if(res.result){
                    inputCmt.value = '';
                    this.getFeedCmtList(param.ifeed, divCmtList, spanMoreCmt);
                }
            });  
        });

        return divContainer;
    },

    //통신할 때 로딩gif 보이기
    showLoading : function() { this.loadingElem.classList.remove('d-none'); },
    hideLoading : function() { this.loadingElem.classList.add('d-none'); }
}

// 해당 주소로 이동
function moveToFeedWin(iuser) {
    location.href = `/user/feedwin?iuser=${iuser}`;
}

// New Feed - 이미지가 첨부된 새로운 피드, JSON으로  DB에 보내기
(function() {
    const btnNewFeedModal = document.querySelector('#btnNewFeedModal');
    if(btnNewFeedModal) {
        const modal = document.querySelector('#newFeedModal');
        const body =  modal.querySelector('#id-modal-body');
        const frmElem = modal.querySelector('form');
        const btnClose = modal.querySelector('.btn-close');

        //이미지 값이 변하면
        frmElem.imgs.addEventListener('change', function(e) {

            if(e.target.files.length > 0) {// 이미지선택
                body.innerHTML = `
                    <div>
                        <div class="d-flex flex-md-row">
                            <div class="flex-grow-1 h-full"><img id="id-img" class="w300"></div>
                            <div class="ms-1 w250 d-flex flex-column">                
                                <textarea placeholder="문구 입력..." class="flex-grow-1 p-1"></textarea>
                                <input type="text" placeholder="위치" class="mt-1 p-1">
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="button" class="btn btn-primary">공유하기</button>
                    </div>
                `;
                const imgElem = body.querySelector('#id-img');

                const imgSource = e.target.files[0];
                const reader = new FileReader(); //자바스크립트 기본객체
                reader.readAsDataURL(imgSource);
                reader.onload = function() {
                imgElem.src = reader.result;
                };

                const shareBtnElem = body.querySelector('button'); //body.innerHTML 안에 있는 button
                shareBtnElem.addEventListener('click', function() {//'공유하기' 버튼 클릭시
                    const files = frmElem.imgs.files;

                    const fData = new FormData(); //자바스크립트 기본객체 = createElement('form')
                    for(let i=0; i<files.length; i++) {
                        fData.append('imgs[]', files[i]);
                    }
                    fData.append('ctnt', body.querySelector('textarea').value);
                    fData.append('location', body.querySelector('input[type=text]').value);

                    // feedController -> function rest() : 새로 작성된 feed 를 DB에 보내는 함수
                    fetch('/feed/rest', {
                        method: 'POST',
                        body: fData
                    }).then(res => res.json())
                        .then(myJson => {
                            console.log(myJson);
                             if(myJson) {
                                btnClose.click(); //json 통신이 끝나면 창이 닫히는 이벤트 실행
                                
                                const lData = document.querySelector('#lData');
                                const gData = document.querySelector('#gdata');
                                if(lData && lData.dataset.toiuser !== gData.dataset.loginiuser) { return; }

                                const feedItem = feedObj.makeFeedItem(myJson);
                                feedObj.containerElem.prepend(feedItem);
                                feedObj.refreshSwipe();
                            }
                        });
                });
            }
        });

        btnNewFeedModal.addEventListener('click', function() {
            const selFromComBtn = document.createElement('button');
            selFromComBtn.type = 'button';
            selFromComBtn.className = 'btn btn-primary';
            selFromComBtn.innerText = '컴퓨터에서 선택';
            selFromComBtn.addEventListener('click', function() {
                frmElem.imgs.click();
                //display-none으로 숨겨져 있는 form->input->file을 클릭함
            });
            body.innerHTML = null;
            body.appendChild(selFromComBtn);
        });
    }

})();

