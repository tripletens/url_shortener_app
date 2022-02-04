@extends('layouts.index')
@section('content')
    @include('const.navbar')
    <!-- <p> landing page here </p> -->
    <style rel="stylesheet"  type="text/css">
        #form-container{
            height:auto;
            width:80%;
            background:#000;
            display:flex;
            flex-direction:row;
            justify-content:center;
            align-items:center;
            margin:0 auto;
            margin-top:25vh;
            color:#fff;
            border-radius:30px;
            padding:30px;
        }
        .input-text{
            margin-top:4px;
            width:100%;
            align-self:center
        }
        .input-label{
            margin-top:4px;
            font-size:24px;
            align-self:center;
        }
        .result{
            height:auto;

        }
    </style>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center flex-row align-center" id="form-container">
            <form method="POST" action="{{route('create_short_url')}}" class="col-md-12">
                @csrf
                <div class="row" >
                    <div class="col-md-2 col-sm-12">
                        <label class="input-label">Enter a URL: </label>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <input type="url" name="url" required class="form-control input-text" placeholder="Enter a URL i.e https://www.facebook.com"/>
                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <button type="submit" class="btn btn-lg  btn-danger">Create Short url</button>
                    </div>
                </div>
            </form>
            @if(session('error'))
                <div class="alert alert-danger p-3 mx-auto mt-5">
                    <p>
                        Sorry we could not create a new url <b> Please contact Admin or try again later.</b>
                    </p>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-info p-3 mx-auto mt-5">
                    <p class="text-center mx-auto my-auto py-auto">
                        Your new url is <b> {{session('new_url')}}. View Short Url</b>
                        <a href="{{session('new_url')}}" id="new_url" target="_blank"> {{session('new_url')}}</a>
                        
                        <button class="btn btn-info btn-sm text-white mr-3" onclick="myFunction()">Copy URL</button>
                        
                    </p>
                    <!-- <hr/>
                    You can share your new url on Social Media
                    <a href="https://www.facebook.com/dialog/share?app_id=2705142856378176&display=popup&href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2F&redirect_uri=https%3A%2F%2Fdevelopers.facebook.com%2Ftools%2Fexplorer" class="btn btn-info btn-sm text-white mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                        </svg>
                    </button> -->
                </div>
            @endif

            <script type="text/javascript">
                function myFunction() {
                    /* Get the new url */
                    var element = document.getElementById("new_url");

                    /* Select the new url */
                    let elementText = element.innerHTML;

                    console.log(elementText);

                    /* Copy the new url */
                    navigator.clipboard.writeText(elementText);

                    /* Alert the copied new url */
                    alert("Copied the new url: " + elementText);
                }

               
                document.getElementById('shareBtn').onclick = function() {
                    FB.ui({
                        display: 'popup',
                        method: 'share',
                        href: 'https://developers.facebook.com/docs/',
                    }, function(response){});
                }
                
            </script>   
        </div>
    </div>
@endsection