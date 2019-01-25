<Form method="POST" action="{{ route('comment.edit')}}">
    @csrf
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