@extends('layouts.app')
@section('corpo')
<checar-logado></checar-logado>
<menu-topo></menu-topo>
<div class="container-fluid">
    <div class="row mt-5 ">
        <div class="col-md-12 ">
            <div class="card ">
                <div class="card-body">

                    <router-view></router-view>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection