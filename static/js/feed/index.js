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

                    fetch('/feed/rest', {
                        method: 'post',
                        body: fData
                    }).then(res => res.json())
                        .then(myJson => {
                            console.log(myJson);
                             if(myJson.result) {
                                btnClose.click(); //json 통신이 끝나면 창이 닫힘
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

    const feedObj = {
        limit : 20,
        itemLength : 0,
        currentPage : 1,
        loadingElem : document.querySelector('.loading'),
        containerElem : document.querySelector('#item_container'),

        getFeedList : function() {
            this.showLoading();
            const param = {
                page : this.currentPage++
            }
            fetch('/feed/rest' + encodeQueryString(param))
            .then(res => res.json())
            .then(list => {
                this.makeFeedList(list);
            })
            .catch(e => {
                console.error(e);
                this.hideLoading();
            });
        }, //DB에서 feed를 받아옴

        makeFeedList : function(list) {
            if(list.length !== 0) {
                list.forEach(item => {
                    const divItem = this.makeFeedItem(item);
                    this.containerElem.appendChild(divItem);
                });
            }
            this.hideLoading();
        }, // getFeedList로 받아온 feed를 리스트 형식으로 

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
                    <div class="circleimg h40 w40">${writerImg}</div>
                </div>
                <div class="p-3 flex-grow-1">
                    <div><span class="pointer" onclick="moveToProfile(${item.iuser});">${item.writer}</span>  <span class="fc-g">- ${regDtInfo}</span></div>
                    <div class="fc-g">${item.location === null ? '' : item.location}</div>
                </div>
            `;
            return divContainer;
        },

        //통신할 때 로딩gif 보이기
        showLoading : function() { this.loadingElem.classList.remove('d-none'); },
        hideLoading : function() { this.loadingElem.classList.add('d-none'); }
    }

    feedObj.getFeedList();

})();