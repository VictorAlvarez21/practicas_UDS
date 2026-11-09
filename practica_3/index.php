<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-5">
                <div class="card shadow-lg border-0 rounded-4">
                    <!-- Encabezado -->
                    <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                        <h2 class="fw-bold mb-2">Bienvenido</h2>
                        <p class="mb-0">
                            Sistema de administración de usuarios
                        </p>
                    </div>
                    <!-- Formulario -->
                    <div class="card-body p-4 p-md-5">
                        <h4 class="text-center mb-4 fw-semibold">
                            Iniciar sesión
                        </h4>
                        <form action="controlador.php" method="POST">
                            <div class="mb-3">
                                <label for="usuario" class="form-label fw-semibold">
                                    Usuario
                                </label>
                                <input type="text" class="form-control form-control-lg" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">
                                    Contraseña
                                </label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                                    Iniciar sesión
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Pie de página -->
                    <div class="card-footer bg-light text-center py-3">
                        <small class="text-secondary">
                            Sistema de acceso por roles
                        </small>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>