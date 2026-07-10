<div
    class="modal fade"
    id="{{ $modalId }}"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-{{ $color }}">

                <h4 class="modal-title">

                    {{ $title }}

                </h4>

                <button
                    type="button"
                    class="close"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <p>

                    {{ $message }}

                </p>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal">

                    Cancelar

                </button>

                <form
                    action="{{ $route }}"
                    method="POST">

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-{{ $color }}">

                        <i class="{{ $icon }}"></i>

                        {{ $button }}

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>