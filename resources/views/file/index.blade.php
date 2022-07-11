<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subir Archivos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <h2 class="text-center mt-3"><b>Subir Archivos</b></h2>
            <input type="hidden" name="token" id="_token" value="{{ csrf_token() }}">
            <form method="POST" id="form_files" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="">Archivo</label>
                    <input type="file" name="files[]" id="files" multiple class="form-control">
                </div>
            </form>
            <button id="btn_subir" class="btn btn-primary">Subir Archivos</button>
        </div>

        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbody_files">

                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/files.js') }}"></script>
</body>

</html>
