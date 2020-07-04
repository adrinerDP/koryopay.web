<div class="container">
    <div class="numpad text-center">
        <div class="row">
            <div class="col-4">
                <div class="number" data-value="1">1</div>
            </div>
            <div class="col-4">
                <div class="number" data-value="2">2</div>
            </div>
            <div class="col-4">
                <div class="number" data-value="3">3</div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="number" data-value="4">4</div>
            </div>
            <div class="col-4">
                <div class="number" data-value="5">5</div>
            </div>
            <div class="col-4">
                <div class="number" data-value="6">6</div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="number" data-value="7">7</div>
            </div>
            <div class="col-4">
                <div class="number" data-value="8">8</div>
            </div>
            <div class="col-4">
                <div class="number" data-value="9">9</div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="number" data-value="00">00</div>
            </div>
            <div class="col-4">
                <div class="number" data-value="0">0</div>
            </div>
            <div class="col-4">
                <div class="number" data-value="-1"><i class="fa fa-arrow-left"></i></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="submit"><i class="fa fa-check"></i> 입력 완료</div>
            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        $(function () {
            var input = $('input#with-numpad');
            input.attr('readonly', 'readonly');
            $('.numpad .number').on('click', function () {
                if ($(this).data('value') >= 0) {
                    if (input.is('[maxlength]')) {
                        if (input.attr('maxlength') > input.val().length) {
                            input.val(input.val() + $(this).data('value'));
                        }
                    } else {
                        input.val(input.val() + $(this).data('value'));
                    }
                } else {
                    if ($(this).data('value') === -1) {
                        input.val(input.val().substring(0, input.val().length - 1));
                    }
                }
            });
            $('.numpad .submit').on('click', function () {
                $('form#with-numpad').submit();
            })
        })
    </script>
@endsection
