
    <div class="container">

        <h3> <b>Sourcing & Demographics </b></h3>

        <div style="box-shadow:0 9px 7px -1px #707070 !important">
            <form action="" style="border: 1px solid #dad7d7;" class="py-4 px-4">

         
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Source</label>
                    <input type="text" class="form-control" value="{{ $user->source }}" id="formGroupExampleInput2">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Employement History</label>
                    <textarea class="form-control" id="formGroupExampleInput2" rows="10" cols="">
                        <?php
                        if (isset($user->emp_history)) {
                            echo implode(' ', array_slice(explode(' ', $user->emp_history), 0, 20)) . "\n";
                        } else {
                            echo 'N/A';
                        }
                        ?>;
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Application Status</label>
                    <input type="text" class="form-control" value="{{ $user->app_status }}"
                        id="formGroupExampleInput2">
                </div>

                <div class="">
                    <div class="col-4 m-auto">
                        <p class="m-0">QR Code:</p>
                        <img class="w-100" src="./images/QR_code_for_mobile_English_Wikipedia.svg.png" alt="">
                    </div>
                </div>
            </form>
        </div>
    </div>
 