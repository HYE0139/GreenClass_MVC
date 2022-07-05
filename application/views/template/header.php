
<div class="header">
    <header class="container py-3">
        <div id="globalConst">
            <div class="d-flex flex-row align-items-center">
                <div class="d-inline-flex flex-grow-1 flex-shrink-0">
                    <a href="/feed/index">
                        <img src="/static/svg/logo.svg">
                    </a>
                </div>
                <div class="d-inline-flex flex-grow-1 flex-shrink-1">
                </div>
                <div class="d-inline-flex flex-grow-1 flex-shrink-0">
                    <nav class="d-flex flex-grow-1 flex-row justify-content-end">
                         <!--게시글 추가-->
                        <div class="d-inline-flex me-3">
                            <a href="#" id="navDropdownMenuLink" data-bs-toggle="dropdown">
                                <svg aria-label="새로운 게시물" class="_8-yf5 " color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 24 24" width="24"><path d="M2 12v3.45c0 2.849.698 4.005 1.606 4.944.94.909 2.098 1.608 4.946 1.608h6.896c2.848 0 4.006-.7 4.946-1.608C21.302 19.455 22 18.3 22 15.45V8.552c0-2.849-.698-4.006-1.606-4.945C19.454 2.7 18.296 2 15.448 2H8.552c-2.848 0-4.006.699-4.946 1.607C2.698 4.547 2 5.703 2 8.552z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="6.545" x2="17.455" y1="12.001" y2="12.001"></line><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="12.003" x2="12.003" y1="6.545" y2="17.455"></line></svg>
                            </a>
                           
                            <ul class="dropdown-menu" aria-labelledby="navDropdownMenuLink">
                                <li>
                                    <a href="#" id="btnNewFeedModal" data-bs-toggle="modal" data-bs-target="#newFeedModal" class="dropdown-item">
                                        <span>                                   
                                            <svg width="24px" height="24px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path fill="var(--ci-primary-color, currentColor)" d="M47.547,63.547V448.453a16,16,0,0,0,16,16H448.453a16,16,0,0,0,16-16V63.547a16,16,0,0,0-16-16H63.547A16,16,0,0,0,47.547,63.547Zm288.6,16h96.3v96.3h-96.3Zm0,128.3h96.3v96.3h-96.3Zm0,128.3h96.3v96.3h-96.3Zm-128.3-256.6h96.3v96.3h-96.3Zm0,128.3h96.3v96.3h-96.3Zm0,128.3h96.3v96.3h-96.3Zm-128.3-256.6h96.3v96.3h-96.3Zm0,128.3h96.3v96.3h-96.3Zm0,128.3h96.3v96.3h-96.3Z" class="ci-primary"/></svg>
                                        </span>
                                        <span>게시</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item">
                                        <span>
                                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="ic_fluent_live_24_regular" fill="#212121" fill-rule="nonzero"><path d="M5.98959236,4.92893219 C6.28248558,5.22182541 6.28248558,5.69669914 5.98959236,5.98959236 C2.67013588,9.30904884 2.67013588,14.6909512 5.98959236,18.0104076 C6.28248558,18.3033009 6.28248558,18.7781746 5.98959236,19.0710678 C5.69669914,19.363961 5.22182541,19.363961 4.92893219,19.0710678 C1.02368927,15.1658249 1.02368927,8.83417511 4.92893219,4.92893219 C5.22182541,4.63603897 5.69669914,4.63603897 5.98959236,4.92893219 Z M19.0710678,4.92893219 C22.9763107,8.83417511 22.9763107,15.1658249 19.0710678,19.0710678 C18.7781746,19.363961 18.3033009,19.363961 18.0104076,19.0710678 C17.7175144,18.7781746 17.7175144,18.3033009 18.0104076,18.0104076 C21.3298641,14.6909512 21.3298641,9.30904884 18.0104076,5.98959236 C17.7175144,5.69669914 17.7175144,5.22182541 18.0104076,4.92893219 C18.3033009,4.63603897 18.7781746,4.63603897 19.0710678,4.92893219 Z M8.81801948,7.75735931 C9.1109127,8.05025253 9.1109127,8.52512627 8.81801948,8.81801948 C7.06066017,10.5753788 7.06066017,13.4246212 8.81801948,15.1819805 C9.1109127,15.4748737 9.1109127,15.9497475 8.81801948,16.2426407 C8.52512627,16.5355339 8.05025253,16.5355339 7.75735931,16.2426407 C5.41421356,13.8994949 5.41421356,10.1005051 7.75735931,7.75735931 C8.05025253,7.46446609 8.52512627,7.46446609 8.81801948,7.75735931 Z M16.2426407,7.75735931 C18.5857864,10.1005051 18.5857864,13.8994949 16.2426407,16.2426407 C15.9497475,16.5355339 15.4748737,16.5355339 15.1819805,16.2426407 C14.8890873,15.9497475 14.8890873,15.4748737 15.1819805,15.1819805 C16.9393398,13.4246212 16.9393398,10.5753788 15.1819805,8.81801948 C14.8890873,8.52512627 14.8890873,8.05025253 15.1819805,7.75735931 C15.4748737,7.46446609 15.9497475,7.46446609 16.2426407,7.75735931 Z M12,10.5 C12.8284271,10.5 13.5,11.1715729 13.5,12 C13.5,12.8284271 12.8284271,13.5 12,13.5 C11.1715729,13.5 10.5,12.8284271 10.5,12 C10.5,11.1715729 11.1715729,10.5 12,10.5 Z" id="🎨-Color"></path></g></g></svg>
                                        </span>
                                        <span>LIVE</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!--다이렉트메세지 DM-->
                        <div class="d-inline-flex me-3">
                            <a href="/dm/index">
                                <svg aria-label="다이렉트메세지" class="_8-yf5 " color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 24 24" width="24"><line fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2" x1="22" x2="9.218" y1="3" y2="10.083"></line><polygon fill="none" points="11.698 20.334 22 3.001 2 3.001 9.218 10.084 11.698 20.334" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></polygon></svg>
                            </a>
                        </div>

                        <!--프로필 메뉴-->
                        <div class="d-inline-flex dropdown"> 
                            <a href="#" role="button" id="navDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" class="header_profile">
                                <div class="circleimg h30 w30">
                                    <img src="/static/img/profile/<?=getMainImgSrc()?>" onerror="this.onerror=null; this.src='/static/img/profile/defaultProfileImg_100.png'" alt="프로필이미지">
                                </div>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navDropdownMenuLink">
                                <li>
                                    <a href="/user/feedwin?iuser=<?=getIuser()?>" class="dropdown-item">
                                        <span>
                                            <svg aria-label="프로필" class="_8-yf5 " color="#262626" fill="#262626" height="16" role="img" viewBox="0 0 24 24" width="16"><circle cx="12.004" cy="12.004" fill="none" r="10.5" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></circle><path d="M18.793 20.014a6.08 6.08 0 00-1.778-2.447 3.991 3.991 0 00-2.386-.791H9.38a3.994 3.994 0 00-2.386.791 6.09 6.09 0 00-1.779 2.447" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></path><circle cx="12.006" cy="9.718" fill="none" r="4.109" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></circle></svg>
                                        </span>
                                        <span>프로필</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="/user/logout" class="dropdown-item">로그아웃</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</div>
<!--New Feed Create Modal-->
<div class="modal fade" id="newFeedModal" tabindex="-1" aria-labelledby="newFeedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" id="newFeedModalContent">

            <div class="modal-header">
                <h5 class="modal-title" id="newFeedModalLabel">새 게시글 작성</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>

            <div class="modal-body" id="id-modal-body"><!-- index.js >> innerHTML --></div>

        </div>
        <form class="d-none">
            <input type="file" accept="image/*" name="imgs" multiple>
        </form>     
    </div>   
</div>

<!--Profile Setting Modal-->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="profileModalContent">

            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">프로필</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
               
            <div class="profile_img circleimg h150 w150 pointer" data-bs-toggle="modal" data-bs-target="#profileImgModal" >
                <img src="/static/img/profile/<?=getMainImgSrc()?>" onerror="this.onerror=null; this.src='/static/img/profile/defaultProfileImg_100.png'" alt="프로필이미지">
            </div>
                
            <div class="modal-body">
                <input type="file" accept="image/*" name="imgs" multiple class="d-none">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">이름</label>
                    <input type="text" class="form-control" id="recipient-name" name="nm" value="<?=getLoginUser()->nm?>">
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">사용자 이름</label>
                    <input type="text" class="form-control" id="message-text" name="email" value="<?=getLoginUser()->email?>">
                </div>
                <div class="mb-3">
                    <label for="intro" class="col-form-label">소개</label>
                    <textarea class="form-control" id="intro" name="intro"><?=getLoginUser()->cmt?></textarea>
                </div>

                <div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>        
    </div>   
</div>

<!--profile update-->
<div class="modal fade t-center" id="profileImgModal" tabindex="-1" aria-labelledby="profileImgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content" id="profileImgModalContent">
            <div class="modal-body-menu bold title">프로필 사진 바꾸기</div>
            <div class="modal-body-menu fblue">사진 업로드</div>
            <div class="modal-body-menu fred">현재 사진 삭제</div>
            <div class="modal-body-menu" data-bs-dismiss="modal" aria-label="close" >취소</div>       
        </div>   
    </div> 
</div>