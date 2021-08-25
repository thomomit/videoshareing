@include('includes.head')
    <body>

    @include('includes.header')
    <main class="top-list">
        <a href="{{ route('post') }}"><div class="mypage-btn">POST</div></a>
        <a href="{{ route('video-list') }}"><div class="mypage-btn">LIST</div></a>
        <a href="{{ route('manage') }}"><div class="mypage-btn">MANAGE</div></a>
    </main>
    <footer>©2021 ALL RIGHTS RESERVED.</footer>
    
    </body>
</html>
