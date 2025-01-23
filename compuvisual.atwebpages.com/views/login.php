<div class="container d-flex justify-content-center align-items-center ">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4">Iniciar Sesion</h3>
        <form method="POST" action="models/entrar.php">
            <div class="mb-3">
                <label for="text" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su usuario" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="clave" name="clave" placeholder="Ingrese su contraseña" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
        </form>
        <?php if (isset($_GET["error"])): ?>
            <p style="color: red;">Usuario o Contraseña incorrecto</p>
        <?php endif; ?>
    </div>
</div>