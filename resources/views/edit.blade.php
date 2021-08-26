@include('includes.head')


        @include('includes.header')

    <h2>VIDEO EDIT</h2>
    <div class="form">
        @csrf
        <div class="post-form">
            <form method="POST" class="form-movie" action="{{ route('try.update', $post->id) }}">
                @method('PUT')
                @csrf

                <dl class="form39">
                    <dt><label for="video_title">TITLE</label></dt>
                    <dd>
                      <input class="text" name="video_title" id="video_title" value="{{ $post->video_title }}" type="text">
                    </dd>
                </dl>

                <dl class="form19">
                    <dt><label for="label5">PUBLIC / PRIVATE</label></dt>
                    <dd>
                        {{
                            Form::select('view',
                            array('1' => 'PUBLIC', '2' => 'PRIVATE'),
                            $post->view_mode,
                            ['id' => 'view', 'name' => 'view_mode', 'required' => 'required', 'class' => 'select'])
                        }}
                    </dd>
                </dl>
                <input type="hidden" name="id" value="{{ $post->id }}" />
                <input type="hidden" name="create_at" value="{{ $post->create_at }}" />
                <input class="submit" type="submit" style="margin-bottom: 24px" value="EDIT">
                <div class="submit" type="button"><a href="{{ route('manage') }}" style="color: #fff;">CANCEL</a></div>
            </form>
            <button class="submit" data-toggle="modal" data-target="#delete_confirm" id="btn-delete" style="background: #DC3546;">DELETE</button>
            <form method="POST" style="padding: 0" action="{{ route('try.delete', $post->id) }}">
                @csrf
                @method('PUT')
                <div class="modal fade" id="delete_confirm" tabindex="-1" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">DELETE THE VIDEO?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div id="now-loading" style="display:none">
                                    <div class="site-spinner">
                                    </div>
                                <div>
                                <p id="sending">SENDING DATA</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                            <button type="submit" class="btn btn-primary" id="delete">YES</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<footer>©2021 ALL RIGHTS RESERVED.</footer>
</body>
</html>
