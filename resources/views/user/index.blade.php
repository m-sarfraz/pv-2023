@extends('layouts.app')
@section('style')
    <!-- ================= -->
    <!-- Datatable css start-->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />
    <!-- Datatable css end-->
    <!-- ================= -->
    <style>
        .row {
            margin: 0px !important;
        }

        #example1_filter label {
            display: flex;
            width: fit-content;
            margin-left: auto;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #dc8627;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #dc8627;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection

@section('content')
    <div class="px-2 container mt-5">
        @can('add-user')
            <a href="{{ route('user.create') }}"><button class="mt-3 mb-3 costumButton px-3">Add
                    +</button></a>
        @endcan
        <table id="userTable" class="table border-0  ">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>UserID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Show Dropdown</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $user)
                    <tr class="bg-transparent">
                        <td>
                            @can('edit-user')
                                <a href="{{ route('user.edit', $user->id) }}">
                                    <i style="cursor: pointer;" class="bi bi-pencil-square"></i>
                                </a>
                            @endcan
                        </td>
                        <td>
                            {{ $user->id }}
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            {{ $user->phone }}
                        </td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" name="status" id="status"
                                    {{ $user->status == 'true' ? 'checked' : '' }}
                                    onchange="changeUserStatus(this, '{{ route('change-user-status') }}', 'changeUserStatus', {{ $user->id }})">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td class="text-center">
                            <input class="form-check-input text-center" type="checkbox" name="dropdown" id="dropdown"
                                {{ $user->showDropdown == 'true' ? 'checked' : '' }}
                                onchange="changeDropdownStatus(this, '{{ route('change-user-status') }}', 'changeDropdownStatus', {{ $user->id }})">

                        </td>
                        <td>
                            {{ date('d-m-y : h:i a', strtotime($user->created_at)) }}
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $("#userTable").DataTable({
                "responsive": true,
                "stateSave" :true
            });
        });

        function changeUserStatus(elem, route, type, id) {
            status = $(elem).is(':checked')
            var data = {
                _token: token,
                type: type,
                id: id,
                status: status,
            };
            ajaxFunc(route, data);
        }

        function changeDropdownStatus(elem, route, type, id) {
            dropdown = $(elem).is(':checked')
            var data = {
                _token: token,
                type: type,
                id: id,
                dropdown: dropdown,
            };
            ajaxFunc(route, data);
        }

        function ajaxFunc(route, data) {
            $.ajax({
                type: "POST",
                url: route,
                data: data,
                // Success fucniton of Ajax
                success: function(data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Change been Saved!',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(() => {
                        location.reload()
                    }, 1200);
                }
            });
        }
    </script>
@endsection
