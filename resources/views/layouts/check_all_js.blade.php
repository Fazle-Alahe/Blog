
@section('footer_script')
    <script>
        $("#chkSelectAll").on('click', function(){
            this.checked ? $(".chkDel").prop("checked", true) : $(".chkDel").prop("checked", false);
        })
    </script>
@endsection