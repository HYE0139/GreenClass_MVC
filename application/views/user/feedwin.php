<div id="lData" data-toiuser="<?=$this->data->iuser?>"></div>
    <div class=" d-flex flex-column align-items-center">
        <div class="size_box_100"></div>
        <div class="w100p_mw614">
            <div class="feedWin-header d-flex flex-row">            
                    <div class="d-flex flex-column justify-content-center">
                        <div class="w250 h150 feedwin container-center">
                            <div class="circleimg h150 w150 pointer" <?php if($this->data->iuser == getIuser()) { ?> data-bs-toggle="modal" data-bs-target="#profileImgModal" <?php } else {?> onclick='btnSizeUp()'<?php }?> >
                                <img class="delprofileImg" src='/static/img/profile/<?=$this->data->iuser?>/<?=$this->data->mainimg?>' onerror='this.error=null;this.src="/static/img/profile/defaultProfileImg_100.png"'>
                            </div>    
                        </div>
                    </div>
                    <script>// 다른 유저 프사 눌렀을 때
                          function btnSizeUp(){
                            const imgBox = document.createElement('div');
                        
                            imgBox.classList = 'modal modal-img d-flex pointer imgBox';
                            imgBox.tabIndex = '2';
                            imgBox.innerHTML = `
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content img-modal-content">
                                    <img src="/static/img/profile/<?=$this->data->iuser?>/<?=$this->data->mainimg?>">
                                </div>
                            </div>`;
                            const main = document.querySelector('main');
                            main.appendChild(imgBox);
                            imgBox.addEventListener('click', () => {
                            imgBox.remove();
                            });
                        };
                    </script>

                    <?php $follower = $this->data->follower; $following = $this->data->following;?>
                    <div class="flex-grow-1 d-flex flex-column justify-content-evenly">
                        <div>
                            <h2 class="rem_email"><?= $this->data->email ?></h2>
                            <?php if($this->data->iuser == getIuser()) { ?>

                            <button type="button" id="btnModProfile" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#profileModal">프로필 수정</button>

                            <?php } else { ?>
                            <button type="button" id="btnFollowToo" data-follow="0" data-follower="<?=$follower?>" class="btn btn-primary btnFollow <?= $follower && !$following ? "" : "d-none" ?> ">맞팔로우 하기</button>
                            <button type="button" id="btnFollow" data-follow="0" data-follower="<?=$follower?>" class="btn btn-primary btnFollow <?= !$follower && !$following ? "" : "d-none" ?> ">팔로우</button>
                            <button type="button" id="btnCancel" data-follow="1" data-follower="<?=$follower?>" class="btn btn-outline-secondary btnFollow <?= $following ? "" : "d-none" ?> ">
                                <svg aria-label="팔로잉" class="_ab6-" color="#262626" fill="#262626" height="15" role="img" viewBox="0 0 95.28 70.03" width="20">
                                    <path d="M64.23 69.98c-8.66 0-17.32-.09-26 0-3.58.06-5.07-1.23-5.12-4.94-.16-11.7 8.31-20.83 20-21.06 7.32-.15 14.65-.14 22 0 11.75.22 20.24 9.28 20.1 21 0 3.63-1.38 5.08-5 5-8.62-.1-17.28 0-25.98 0zm19-50.8A19 19 0 1164.32 0a19.05 19.05 0 0118.91 19.18zM14.76 50.01a5 5 0 01-3.37-1.31L.81 39.09a2.5 2.5 0 01-.16-3.52l3.39-3.7a2.49 2.49 0 013.52-.16l7.07 6.38 15.73-15.51a2.48 2.48 0 013.52 0l3.53 3.58a2.49 2.49 0 010 3.52L18.23 48.57a5 5 0 01-3.47 1.44z"></path>
                                </svg>
                            </button>
                            <?php } ?>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="flex-grow-1">게시물 <span class="bold"><?=$this->data->feedcnt?></span></div>
                            <div class="flex-grow-1">팔로워 <span class="bold" id="cntFollower"><?=$this->data->followerCnt?></span></div>
                            <div class="flex-grow-1">팔로우 <span class="bold"><?=$this->data->followCnt?></span></div>
                        </div>
                        <div class="bold"><?=$this->data->nm?></div>
                        <div><?=$this->data->cmt?></div>
                    </div>
            </div>
            <div id="item_container"></div>
        </div>
        <div class="loading d-none"><img src="/static/img/loading.gif"></div>

    </div>

    <!--Profile Image Update-->
<div class="modal fade t-center" id="profileImgModal" tabindex="-1" aria-labelledby="profileImgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content" id="profileImgModalContent">
            <div class="profile-modal-title bold">프로필 사진 바꾸기</div>
            <div id="btnProfileImgUp" class=" modal-item fblue">사진 업로드</div>
            <div id="btnDelCurrentProfilePic" class="modal-item fred">현재 사진 삭제</div>
            <div id="btnProfileImgModalClose" class="modal-item" data-bs-dismiss="modal" aria-label="close" >취소</div>    
        </div>   
    </div>

    <form class="d-none">
        <input type="file" accept="image/*" name="imgs" >
    </form> 
</div>

<!--Profile Setting Modal-->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="profileModalContent">

            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">프로필</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
               
            <div class="profile_img circleimg h150 w150 pointer">
                <img class="delprofileImg" src="/static/img/profile/<?=$this->data->iuser?>/<?=$this->data->mainimg?>" onerror="this.onerror=null; this.src='/static/img/profile/defaultProfileImg_100.png'" alt="프로필이미지">
            </div>
                
            <div class="modal-dialog modal-dialog-centered">
                <button>수정</button>
                <div id ="delbutton"class="fred">삭제</div>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div><?=getLoginUser()->email?></div>
                </div>
                <input type="file" accept="image/*" name="imgs" multiple class="d-none">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">이름</label>
                    <input type="text" class="form-control" id="recipient-name" name="nm" value="<?=getLoginUser()->nm?>">
                </div>
              
                <div class="mb-3">
                    <label for="intro" class="col-form-label">소개</label>
                    <textarea class="form-control" id="intro" name="intro"><?=getLoginUser()->cmt?></textarea>
                </div>

                <div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                    <button type="submit" class="btn btn-primary">저장</button>
                </div>
            </div>
        </div>        
    </div>   
</div>

