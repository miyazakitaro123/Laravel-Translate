@extends('layouts.app')
@section('css')

<style>
    .form-check {
        display:inline;
    }
    .btn-white {
        cursor: pointer;
        background-color: white;
        border: 1px solid darkgrey
    }
    *, :after, :before {
        box-sizing: border-box;
        border: 0 solid #70d77c;
    }
    .agree {
        padding:20px;
        border:1px solid black;
        margin: 60px;
    }
</style>
@endsection
@section('content')
    <div class="container">
        <div class="row mt-sm-4">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <form id="form" method="POST" action="{{ route('profile.translator.update_career') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header">
                            <h4>登録情報変更</h4>
                            <div class="d-flex justify-content-center align-items-center my-4">
                                <div id="grad1"></div>
                            </div>
                            <p class="">
                            以下の入力フォームを入力して下さい。
                            </p>
                        </div>
                        <div class="card-body">

                            <!-- career -->
                            <h5 class="my-8" style="padding-right: 15px;padding-left: 15px;">実績・スキルについて</h5>

                            <div class="form-group row">
                                <label class="col-md-4">{{ __('対応言語') }}</label>
                                <div class="col-md-8">
                                    <select class="form-control @error('language') is-invalid @enderror" name="language" id="language" >
                                        <option value="">-- 選んでください --</option>
                                        @foreach (config('myconfig.language') as $key => $value)
                                            <option value="{{$key}}" {{ $key === auth()->user()->language  ? 'selected' : '' }} >{{$value}}</option>
                                         @endforeach
                                    </select>
                                    @error('language')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">{{ __('専門分野') }}</label>
                                <div class="col-md-8">
                                    <select class="form-control @error('category') is-invalid @enderror" name="category" id="category" >
                                        <option value="">-- 選んでください --</option>
                                        @foreach (config('myconfig.category') as $key => $value)
                                            <option value="{{$key}}" {{ $key === auth()->user()->category  ? 'selected' : '' }} >{{$value}}</option>
                                         @endforeach
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-center">
                            <button class="ec_button" type="button" onclick="showModal()">
                                確認する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- modal part -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">

                        <div class="card">

                            <div class="card-header">
                                <h4>登録情報変更</h4>
                                <div class="d-flex justify-content-center align-items-center my-4">
                                    <div id="grad1"></div>
                                </div>

                            </div>
                            <div class="card-body">

                                <!-- career -->
                                <h5 class="mt-16 mb-8"  style="padding-right: 15px;padding-left: 15px;">実績・スキルについて</h5>

                                <div class="form-group row">
                                    <label class="col-md-4">{{ __('対応言語') }}</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="modal_language" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4">{{ __('専門分野') }}</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="modal_category" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-center">
                                <button class="ec_button" type="button" data-dismiss="modal">
                                    情報を修正する
                                </button>
                                <button class="ec_button" type="button" onclick="send()">
                                    登録する
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    <div>
@endsection
@section('js')

<script>

    function showModal()
    {

        //career
        $("input[name='modal_language']").val($("#language option:selected").text());
        $("input[name='modal_category']").val($("#category option:selected").text());

        $("#myModal").modal({backdrop: false});
        $("#myModal").modal('show');
    }
    function send()
    {
        document.getElementById('form').submit();
    }
    </script>
@endsection
