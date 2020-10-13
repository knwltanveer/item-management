@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header"> <h1>{!! config('app.name', trans('titles.app')) !!} </h1></div>

                <div class="card-body">
                    <item-management></item-management>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
