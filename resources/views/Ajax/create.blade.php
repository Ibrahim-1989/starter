<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <title>Create Ajax Offer</title>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
    
            .full-height {
                height: 100vh;
            }
    
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
    
            .position-ref {
                position: relative;
            }
    
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
    
            .content {
                text-align: center;
            }
    
            .title {
                font-size: 84px;
            }
    
            .error {
                color: #ae1c17;
            }
    
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
    
            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        {{-- @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                 {{ Session::get('success') }}
            </div>
        @endif --}}
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li class="nav-item active">
                            <a class="nav-link"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }}
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                {{-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> --}}
            </div>
        </nav>
        <div class="container">
            <div class="alert alert-success" id="success_msg" style="display: none;">
                تم الحفظ بنجاح
            </div>
            <h6> إضافة عرض جديد </h6>
            <form method="POST" id="OfferForm" enctype="multipart/form-data">
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="imge">{{__('messages.photo')}}</label>
                        <input type="file" class="form-control" name="imge" id="imge">
                        @error('imge')
                            <span class="form-text text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="name_ar">{{__('messages.Offer Name Arabic_Lb') }}</label>
                        <input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="{{__('messages.Offer Name Arabic_Lb') }}...">
                        @error('name_ar')
                            <span class="form-text text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="name_en">{{__('messages.Offer Name English_Lb') }}</label>
                        <input type="text" class="form-control" name="name_en" id="name_en" placeholder="{{__('messages.Offer Name English_Lb') }}...">
                        @error('name_en')
                        <span class="form-text text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="form-row">
                  <div class="col-md-12">
                    <label for="price">{{__('messages.Offer Price_Lb') }}</label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="{{__('messages.Offer Price_Lb') }}...">
                    @error('price')
                    <span class="form-text text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                  <label for="details_ar">{{__('messages.Offer Details Arabic_Lb') }}</label>
                  <textarea class="form-control" name="details_ar" id="details_ar"  placeholder="{{__('messages.Offer Details Arabic_Lb') }}..."></textarea>
                  @error('details_ar')
                        <span class="form-text text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                  <label for="details_en">{{__('messages.Offer Details English_Lb') }}</label>
                  <textarea class="form-control" name="details_en" id="details_en"  placeholder="{{__('messages.Offer Details English_Lb') }}..."></textarea>
                  @error('details_en')
                        <span class="form-text text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <br>
                        <button id="btn-saveOffer" class="btn btn-primary">{{__('messages.Offer btnSave') }}</button>
                    </div>
                    
                </div>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>

            $(document).on('click','#btn-saveOffer',function(e){

                e.preventDefault();
                debugger;

                var formData = new FormData($('#offerForm')[0]);

                // $.ajax({
                // type:'POST',
                // url: "{{route('Ajax-Offer.store')}}",
                // data:{
                //     // 'imge':$("input[name='imge']").val(),
                //     // 'name_ar':$("input[name='name_ar']").val(),
                //     // 'name_en':$("input[name='name_en']").val(),
                //     // 'price':$("input[name='price']").val(),
                //     // 'details_ar':$("input[name='details_ar']").val(),
                //     // 'details_en':$("input[name='details_en']").val(),
                //     // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                // contentType: "application/json; charset=utf-8",
                // dataType: "json",
                // sucess:function(data){
                //     debugger;

                // },
                // error:function(reject){

                // }
                // });
                var details_en = $('#details_en').val();
                var details_ar = $('#details_ar').val();
                debugger;
                var Offerdata = {};
                Offerdata = {
                'imge':$("input[name='imge']").val(),
                'name_ar':$("input[name='name_ar']").val(),
                'name_en':$("input[name='name_en']").val(),
                'price':$("input[name='price']").val(),
                'details_ar':details_ar,
                'details_en': details_en,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: "{{url('Ajax-Offer/store')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: Offerdata,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    debugger;
                    if (data.status == true) {
                        $('#success_msg').show();
                    }


                }, error: function (reject) {
                    debugger;
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });

            });
            
            
            
        </script>
        
    </body>
</html>
