@extends('layouts.app', [
  'title' => 'Form Layouts',
  'description' => 'Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.'
])

@section('vendor-css')
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
@endsection

@section('content-css')
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/pickers/form-pickadate.css">
@endsection

@section('content')
    <div class="app-content content " style="padding: calc(2rem) 2rem 0 !important; margin-left: 0px !important; ">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Бронирования кабинета</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Форма бронирование</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form" action="{{route('reserve.cabinet')}}" method="POST">
                                        @csrf
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                @if($errors->any())
                                                    {{ implode('', $errors->all('<div>:message</div>')) }}
                                                @endif
                                                <h4 class="text-{!! \Session::get('class') !!}" >{!! \Session::get('msg') !!}</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="basicSelect">Кабинет</label>
                                                    <select class="form-control" id="cabinet_id" name="cabinet_id" required>
                                                        @foreach($cabinets as $cabinet)
                                                            <option value="{{$cabinet->id}}" @if(old('cabinet_id')==$cabinet->id) selected @endif >{{$cabinet->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('cabinet_id'))
                                                       <div class="alert alert-danger">{{ $errors->first('cabinet_id') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">ФИО</label>
                                                    <input type="text" id="name-column" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="ФИО" name="name" value="{{old('name')}}" required/>
                                                    @if($errors->has('name'))
                                                        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Email</label>
                                                    <input type="email" id="email-column" class="form-control @if($errors->has('email')) is-invalid @endif" name="email" placeholder="Email" value="{{old('email')}}" required/>
                                                    @if($errors->has('email'))
                                                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Номер телефона</label>
                                                    <input type="text" id="phone-column" class="form-control @if($errors->has('phone')) is-invalid @endif" placeholder="992929990259" name="phone" value="{{old('phone')}}" required/>
                                                    @if($errors->has('phone'))
                                                        <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="fp-date-time">Date & TIme</label>
                                                    <input type="text" id="from_date_time" class="form-control flatpickr-date-time  @if($errors->has('from_date_time')) is-invalid @endif" name="from_date_time" placeholder="YYYY-MM-DD HH:MM" value="{{old('from_date_time')}}" required/>
                                                    @if($errors->has('from_date_time'))
                                                        <div class="alert alert-danger">{{ $errors->first('from_date_time') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="fp-date-time">Date & TIme</label>
                                                    <input type="text" id="to_date_time" class="form-control flatpickr-date-time" name="to_date_time" placeholder="YYYY-MM-DD HH:MM" value="{{old('to_date_time')}}" required/>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Floating Label Form section end -->

            </div>
        </div>
    </div>
@endsection

@section('vendor-js')
    <script src="/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
@endsection

@section('content-js')
    <script src="/app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
    <script>
        $(document).ready(function() {
            const to_date_time = flatpickr("#to_date_time", {
                enableTime: true,
                defaultHour: 9,
                maxTime: '17:00',
                minTime: '8:00',
                dateFormat: 'Y-m-d H:i'

            });
            to_date_time.setDate({{old('to_date_time')}});
            const from_date_time = flatpickr("#from_date_time", {
                enableTime: true,
                defaultHour: 8,
                maxTime: '17:00',
                minTime: '8:00',
                dateFormat: 'Y-m-d H:i'

            });
            from_date_time.setDate({{old('from_date_time')}});

        });
    </script>
@endsection

