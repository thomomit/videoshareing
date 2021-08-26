@include('includes.head')


        @include('includes.header')

    <h2>VIDEO POST</h2>
    <div class="form">
        @csrf
        <div class="post-form">
            <div class="form-messeage">FILL OUT THE FORM TO POST.</div>
            <div class="form-box">
                <form class="form-movie" action="">

                    <dl class="form39">
                        <dt><label for="video_title">TITLE</label></dt>
                        <dd>
                          <input class="text" name="video_title" id="video_title" type="text">
                        </dd>
                    </dl>
                   
                    <dl class="form19">
                        <dt><label for="view_mode">VIEW MODE</label></dt>
                        <dd>
                          <select class="select" name="view_mode" id="view_mode">
                            <option value="1">PUBLIC</option>
                            <option value="2">PRIVATE</option>
                          </select>
                        </dd>
                    </dl>
                    
                    <dl>
                        <dt><label for="file_name">VIDEO UPLOAD</label></dt>
                        <dd>
                            <input type="file" class="file" value="CHOSE VIDEO" id="file_name" name="file_name" accept="video/*">
                        </dd>
                    </dl>
                    
                    <input class="submit" type="button" value="POST" id="post_check">
                </form>
            </div>

            <!-- COMFIRM MODAL -->
            <div class="modal fade" id="post_confirm" tabindex="-1" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="display: initial">
                            <p id="exampleModalLabel">COMFIRM?</p>
                        </div>
                        <div class="modal-body">
                            <div class="confirm-box">
                               
                                <dl>
                                    <dt>TITLE</dt>
                                    <dd id="modal_video_title"></dd>
                                </dl>
                                
                                <dl>
                                  <dt>PUBLIC / PRIVATE</dt>
                                  <dd id="modal_view_mode"></dd>
                                </dl>

                                <dl>
                                    <dt>VIDEO</dt>
                                    <dd id="douga"></dd>
                                  </dl>
                               
                            </div>
                            <div id="now-loading" style="display:none">
                                <div class="site-spinner">
                                </div>
                                <div>
                                    <p id="sending">SENDING....</p>
                                    <div id="msg">
                                        <p>IT MIGHT TAKE FEW MINUTES. SORRY.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button id="no" type="button" style="display:block; background: #DC3546;" class="btn btn-secondary" data-dismiss="modal">NO</button>
                              <button type="submit" style="display:block" class="btn btn-primary" id="submit">YES</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- VALIDATION ERROR MODAL -->
            <div class="modal fade" id="post_denied" tabindex="-1" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="display: initial">
                            <h5 class="modal-title" id="exampleModalLabel">some has not been entered yet.</h5>
                        </div>
                        <div class="modal-body">
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">BACK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>©2021 ALL RIGHTS RESERVED.</footer>
</body>
</html>
