@extends('admin')
@section('contentA')

    <template v-if = "menu==0">
        <h1>Users</h1>
    </template>
    <template v-if = "menu==1">
        <products></products>
    </template>

 
@endsection
    