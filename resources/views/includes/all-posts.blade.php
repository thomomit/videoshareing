
<div class="venue-body">
    <div class="inner">
        @php
            $video_count = count($videos);
        @endphp
        <div class="venue-body-items" id="video-list-block" video-num="{{$video_count}}">
            @php
            $i = 0;
            $cno = 0;
            @endphp
            @foreach($videos as $video)
            <button data-toggle="modal" vid="{{ $i }}" data-target="#Modal{{ $i }}" class="venue-body-items-hide venue-body-item video-modal">
                <div class="all-videos" data-no="{{ $videos->count() }}"></div>
                <input type="hidden" name="modalNo" value="{{ $i }}" />
                <img class="venue-body-img" src="/thumbnail/{{ $video->thumbnail }}" alt="">
                <div class="venue-body-content">{{ $video->video_title }}<br><br>LIKES: {{ $video->iine_count }}<br>VIEWS: {{ $video->view_count }}
                </div>
            </button>

            <!-- VIDEO MODAL -->
            <div class="modal fade single-video" id="Modal{{ $i }}" vid="{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p>Click the video to play</p>
                            <button type="button" id="modal-close{{ $i }}" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <video loop id="modalV{{ $i }}" data-id="{{ $video->id }}" class="modal-video all-posts-modal" preload type="video/mp4" playsinline poster="/thumbnail/{{ $video->thumbnail }}" src="/video/{{ $video->converted }}" alt="{{ $video->video_title }}"></video>
                            
                            <div class="venue-top-ballon-body">
                                <div class="venue-top-ballon-body-item reaction-count" video-id="iine-{{$video->id}}">
                                    <button class="venue-top-ballon-body-reaction iine-{{$video->id}}">LIKE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php
            $i++
            @endphp
            @endforeach
        </div>
       
    </div>
</div>

