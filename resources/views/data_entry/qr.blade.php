<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->last_name }}'s Details</title>
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/custom_css/global.css') }}" />
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="style.css"> -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
</head>

<body>
    <div class="container">

        <h3> <b>Sourcing & Demographics </b></h3>

        <div style="box-shadow:0 9px 7px -1px #707070 !important" class="mb-4">
            <form action="" style="border: 1px solid #dad7d7;" class="py-4 px-4">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">First Name :*</label>
                    <input readonly type="text" class="form-control" value="{{ $user->first_name }}"
                        id="formGroupExampleInput">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Last Name :*</label>
                    <input readonly type="text" class="form-control" value="{{ $user->last_name }}"
                        id="formGroupExampleInput2">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Candidate's Profile</label>
                    <input readonly type="text" class="form-control" value="{{ $user->candidate_profile }}"
                        id="formGroupExampleInput">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Position Applied</label>
                    <input readonly type="text" class="form-control" value="{{ $user->position_applied }}"
                        id="formGroupExampleInput2">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Manner Of Invite</label>
                    <input readonly type="text" class="form-control" value="{{ $user->manner_of_invite }}"
                        id="formGroupExampleInput">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Source</label>
                    <input readonly type="text" class="form-control" value="{{ $user->source }}"
                        id="formGroupExampleInput2">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Employment History</label>
                    <textarea readonly class="form-control" id="formGroupExampleInput2" rows="10" cols=""><?php
                        if (isset($user->emp_history)) {
                            echo $user->emp_history;
                            //  implode(' ', array_slice(explode(' ', $user->emp_history), 0, 20)) . "\n"
                        } else {
                            echo 'No Employment History Found';
                        }
                        ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Application Status</label>
                    <input readonly type="text" class="form-control" value="{{ $user->app_status }}"
                        id="formGroupExampleInput2">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">QR Code</label>
                    <div class="col-12 m-auto align-items-center">
                        {!! $user->qrImage !!}
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
