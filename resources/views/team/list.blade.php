@extends('layouts.app')
@section('content')

<div class="container mt-5">
        <div><input type="text" name="team" /></div>
        <a href="{{ route('team.create') }}" ><button class="mt-3">Add +</button></a>
        <div class="table-responsive mt-5 border text-center">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>update</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                  @foreach($users as $user)
                      <td>{{ $user->name  }}</td>
                      <td>
                          <a href="{{ route('team.edit',$user->id)  }}" ><i style="cursor: pointer;" class="fa fa-edit"></i></a>
                      </td>
                  @endforeach
              </tr>
            </tbody>
          </table>
        </div>
      </div>

@endsection

@section('script')

@endsection
