@extends('layouts.app')
@section('content')

<div class="container mt-5">
        <div><input type="text" name="team" /></div>
        <button class="mt-3">Add +</button>
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
                <td>team1</td>
                <td>
                  <i style="cursor: pointer;" class="fa fa-edit"></i>
                </td>
              </tr>
              <tr>
                <td>team2</td>
                <td>
                  <i style="cursor: pointer;" class="fa fa-edit"></i>
                </td>
              </tr>
              <tr>
                <td>team3</td>
                <td>
                  <i style="cursor: pointer;" class="fa fa-edit"></i>
                </td>
              </tr>
              <tr>
                <td>team4</td>
                <td>
                  <i style="cursor: pointer;" class="fa fa-edit"></i>
                </td>
              </tr>
              <tr>
                <td>team5</td>
                <td>
                  <i style="cursor: pointer;" class="fa fa-edit"></i>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

@endsection

@section('script')
    
@endsection
