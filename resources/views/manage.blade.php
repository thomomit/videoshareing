@include('includes.head')


        @include('includes.header')
        <h2>VIDEO MANAGE</h2>
        <div class="movie">
            <div class="inner" style="padding-bottom: 24px">
                <table class="control-table">
                    <tr class="control-table-head">
                        <td class="control-table-left"></td>
                        <th style="background-color: #E6E6E6;">TITLE</th>
                        <th style="background-color: #F2F2F2;">VIEW MODE</th>
                        <th style="background-color: #E6E6E6;">DATE</th>
                        <th style="background-color: #F2F2F2;">LIKES</th>
                        <th style="background-color: #E6E6E6;">VIEWS</th>
                        <th style="background-color: #F2F2F2;">ERROR<br>MESSAGE</th>
                        <th style="background-color: #E6E6E6;">EDIT</th>
                    </tr>
                    <tbody>
                    @php
                    $i = 0
                    @endphp
                    @foreach($videos as $video)
                    <tr>
                        <td><img class="control-table-image js-modal-open" data-toggle="modal" data-target="#Modal{{ $i }}" src="/thumbnail/{{ $video->thumbnail }}" alt={{ $video->video_title }} controls></td>
                        <td>
                            <div class="control-date">{{ $video->video_title }}</div>
                        </td>
                        <td>
                            <div class="control-table-df">
                            @if($video->view_mode == 1)
                            <img class="control-table-mark" src="../storage/image/view_on.png" alt="PUBLICICON">
                            PUBLIC
                            @else
                            <img class="control-table-mark" src="../storage/image/view_off.png" alt="PRIVATEICON">
                            PRIVATE
                            @endif
                            </div>
                        </td>
                        <td>
                            <div class="control-date">{{ $video->create_at }}</div>
                        </td>
                        <td>
                            <div class="control-reaction">
                                <div class="control-reaction-items">
                                    @if($video->iine_count)
                                    <div class="control-reaction-item-cnt">{{ $video->iine_count }}</div>
                                    @else
                                    <div class="control-reaction-item-cnt">0</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td style="vertical-align: middle;">
                            <div class="control-view">{{ $video->view_count }}</div>
                        </td>
                        <td style="vertical-align: middle;">
                            <div class="control-view" style="line-height:1em;">{{ $video->error_comment }}</div>
                        </td>
                        <td style="vertical-align: middle;">
                            <div class="control-edit"><a href="{{ action('TPostController@edit', $video->id) }}">EDIT</a></div>
                        </td>
                    </tr>

                    <!-- VIDEO MODAL -->
                    <div class="modal fade" id="Modal{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <video style="width: 100%" preload muted="muted" type="video/mp4" playsinline id="vp" poster="/thumbnail/{{ $video->thumbnail }}" src="/video/{{ $video->converted }}" alt="{{ $video->video_title }}" controls></video>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                    $i++
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer>©2021 ALL RIGHTS RESERVED.</footer>
</body>
</html>
