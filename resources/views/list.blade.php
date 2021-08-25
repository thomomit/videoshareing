@include('includes.head')

    @include('includes.header')

    <h2>VIDEO LIST</h2>
    @include('includes.all-posts', ['video'=>$videos])
    <footer>©2021 ALL RIGHTS RESERVED.</footer>
</body>
</html>
