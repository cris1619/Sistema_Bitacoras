<div
    class="modal fade"
    id="{{ $modalId }}"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-warning">

                <h4 class="modal-title">

                    Restablecer contraseña

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

                <div class="alert alert-info mb-0">

                    <i class="fas fa-info-circle"></i>

                    La contraseña volverá a ser el número de documento registrado del usuario.

                </div>

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
                        class="btn btn-warning">

                        <i class="fas fa-key"></i>

                        Restablecer

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>