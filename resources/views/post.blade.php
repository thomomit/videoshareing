@include('includes.head')


        @include('includes.header')

    <h2>VIDEO POST</h2>
    <div class="form">
        @csrf
        <div class="post-form">
            <div class="form-messeage">FILL FORMS AND SUBMIT.</div>
            <div class="form-box">
                <form class="form-movie" action="">

                    <dl class="form39">
                        <dt><label for="team">TITLE</label></dt>
                        <dd>
                          <input class="text" name="team" id="team" type="text">
                        </dd>
                    </dl>
                   
                    <dl class="form19">
                        <dt><label for="label5">PUBLIC / PRIVATE</label></dt>
                        <dd>
                          <select id="view" class="select" name="view" id="view">
                            <option value="1">PUBLIC</option>
                            <option value="2">PRIVATE</option>
                          </select>
                        </dd>
                    </dl>
                    
                    <dl>
                        <dt><label for="label7">VIDEO UPLOAD</label></dt>
                        <dd>
                            <input type="file" class="file" value="CHOSE VIDEO" id="file-name" name="file-name" accept="video/*">
                        </dd>
                    </dl>
                    
                    <input class="submit" type="button" value="POST" id="post_check">
                </form>
            </div>

            <div class="modal fade" id="post_confirm" tabindex="-1" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">COMFIRM?</h5>
                        </div>
                        <div class="modal-body">
                            <div class="confirm-box">
                               
                                <dl>
                                    <dt>TITLE</dt>
                                    <dd id="teamname"></dd>
                                </dl>
                                
                                <dl>
                                  <dt>PUBLIC / PRIVATE</dt>
                                  <dd id="show"></dd>
                                </dl>
                               
                            </div>
                            <div id="now-loading" style="display:none">
                                <div class="site-spinner">
                                </div>
                                <div>
                                    <p id="sending">SENDING</p>
                                    <div id="msg">
                                        <p>IT MIGHT TAKE FEW MINITES. SORRY.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button id="no" type="button" style="display:block" class="btn btn-secondary" data-dismiss="modal">NO</button>
                              <button type="submit" style="display:block" class="btn btn-primary" id="submit">YES</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="post_denied" tabindex="-1" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
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
