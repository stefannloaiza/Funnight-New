<!-- Styles -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet"> {{--
<link href="{{ asset('css/preview.css') }}" rel="stylesheet"> --}} {{--
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css"
/>

<!-- Styles -->
<style>
    html,
    body {
        background-image: url("{{ asset('img/fondo2.jpg') }}");
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: 100%;
        font-weight: 100;
        /* height: 100vh; */
        margin: 0;
    }

    .titles {
        color: white;
    }

    .form-check {
        padding: 0;
    }

    input[type="checkbox"] {
        margin: 4px -15px 0 0;
    }

    .form-check-label {
        margin-left: 15px;
    }

    .card {
        /* width: 80%; */
        border: 0;

        margin-bottom: 25px;
        color: aquamarine;
        background-color: rgba(11, 11, 11, .9);
        /* border-bottom: 1px solid rgba(0,0,0,.125);     */
        border-radius: 7px;
    }

    .row {
        /* background-color: white; */
        border-radius: 5px;
    }

    .center {
        margin: auto;
        width: 50%;
        padding: 10px;
        color: aquamarine;
    }
</style>

<Form method="POST" action="{{ route('comment.edit')}}">
    @csrf

    <div class="center">
        <h1>Actualizar Comentario</h1>
    </div>
    <div class="col-sm-12">
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="id" value="{{ $comment->id }}" hidden/> {{-- {{ $comment->id }} --}}
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="content" value="{{ $comment->content }}" /> {{-- {{ $comment->content }}
                        --}}
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-8">
                        <button class="btn btn-sm btn btn-warning" type="submit">
                            Actualizar
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</Form>