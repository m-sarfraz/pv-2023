@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />
    <style>
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1>User is being redirected....</h1>
            </div>
        </div>
    </div>
    <div style="height: 30px;"></div>
@endsection
@section('script')
    <script>
      cid =   {!! $cid !!}
      uid =   {!! $uid !!}
   
      $.ajax({
            url: "{{ route('checkIfQRScanned') }}",
            type: 'get',
            success: function(res) {
                if (res.success==true) {
                    window.location.href = res.url;
                }
                else{
                    return false
                }
            }
        });
    </script>
@endsection
