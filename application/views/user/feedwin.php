<div id="gData" data-toiuser="<?=$this->data->iuser?>"></div>
    <div class="d-flex flex-column align-items-center">
        <div class="size_box_100"></div>
        <div class="w100p_mw614">
            <div class="d-flex flex-row">            
                    <div class="d-flex flex-column justify-content-center">
                        <div class="circleimg h150 w150 pointer feedwin" id="profileImg" <?php if($this->data->iuser == getIuser()) { ?> data-bs-toggle="modal" data-bs-target="#myProfileModal" <?php } ?>>
                            <img src='/static/img/profile/<?=$this->data->iuser?>/<?=$this->data->mainimg?>' onerror='this.error=null;this.src="/static/img/profile/defaultProfileImg_100.png"'>
                        </div>
                    </div>

                    <?php $follower = $this->data->follower; $following = $this->data->following;?>
                    <div class="flex-grow-1 d-flex flex-column justify-content-evenly">
                        <div>
                            <?= $this->data->email ?>
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
                            <div class="flex-grow-1">팔로워 <span class="bold"><?=$this->data->followerCnt?></span></div>
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

