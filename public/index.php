<?php
session_start();

// =========================
// AUTOLOAD
// =========================
spl_autoload_register(function ($class) {

    $paths = [
        "../app/core/$class.php",
        "../app/models/$class.php",
        "../app/controllers/$class.php",
        "../app/controllers/admin/$class.php",
        "../app/controllers/website/$class.php",
        "../config/$class.php"
    ];

    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// ====================================================
//  BYPASS UNTUK FILE STATIS DI /public/uploads/
// ====================================================
$requestUri = $_SERVER['REQUEST_URI'];

if (preg_match('#^/uploads/#', $requestUri)) {
    $filePath = __DIR__ . $requestUri;

    if (file_exists($filePath)) {
        $mime = mime_content_type($filePath);
        header("Content-Type: $mime");
        readfile($filePath);
        exit;
    }

    http_response_code(404);
    echo "File tidak ditemukan";
    exit;
}

// =========================
// BACA URL
// =========================
$url = isset($_GET['url']) ? trim($_GET['url'], '/') : 'home';
$segments = explode('/', $url);


// ===================================================================================
//                                    ROUTER ADMIN
// ===================================================================================
if ($segments[0] === "admin") {

    // ---- 1. ROUTE: /admin/dashboard ----
    if (($segments[1] ?? '') === 'dashboard') {

        $controllerName = "DashboardController";
        $method = "index";
        $param = $segments[2] ?? null;

        $controllerPath = "../app/controllers/admin/{$controllerName}.php";
        require_once $controllerPath;

        $controller = new $controllerName();
        $param ? $controller->$method($param) : $controller->$method();

        exit;
    }

    // ---- 2. ROUTING AUTH ----
    $authMethods = ['login', 'doLogin', 'register', 'doRegister', 'logout'];

    if (in_array($segments[1] ?? '', $authMethods)) {

        $controllerName = "AuthController";
        $method = $segments[1] ?? "login";
        $param = $segments[2] ?? null;

        $controllerPath = "../app/controllers/admin/{$controllerName}.php";

        if (!file_exists($controllerPath)) {
            die("Controller {$controllerName} tidak ditemukan:<br>{$controllerPath}");
        }

        require_once $controllerPath;
        $controller = new $controllerName();

        if (!method_exists($controller, $method)) {
            die("Method {$method} tidak ditemukan di {$controllerName}");
        }

        $param ? $controller->$method($param) : $controller->$method();

        exit;
    }

    // ---- 3. ADMIN LAIN (ex: dosen, publikasi, gallery) ----
    $controllerName = ucfirst($segments[1] ?? 'dashboard') . "Controller";
    $method = $segments[2] ?? "index";
    $param = $segments[3] ?? null;

    $controllerPath = "../app/controllers/admin/{$controllerName}.php";

    if (!file_exists($controllerPath)) {
        die("Controller {$controllerName} tidak ditemukan:<br>{$controllerPath}");
    }

    require_once $controllerPath;

    if (!class_exists($controllerName)) {
        die("Class {$controllerName} tidak ditemukan!");
    }

    $controller = new $controllerName();

    if (!method_exists($controller, $method)) {
        die("Method {$method} tidak ditemukan di {$controllerName}!");
    }

    $param ? $controller->$method($param) : $controller->$method();

    exit;
}





// ===================================================================================
//                            ROUTING WEBSITE DEFAULT
// ===================================================================================

$controllerName = ucfirst($segments[0]) . "Controller";
$method = $segments[1] ?? "index";
$param = $segments[2] ?? null;

$controllerPath = "../app/controllers/website/{$controllerName}.php";

if (!file_exists($controllerPath)) {
    die("Controller {$controllerName} tidak ditemukan:<br>{$controllerPath}");
}

require_once $controllerPath;

if (!class_exists($controllerName)) {
    die("Class {$controllerName} tidak ditemukan!");
}

$controller = new $controllerName();

if (!method_exists($controller, $method)) {
    die("Method {$method} tidak ditemukan di {$controllerName}!");
}

$param ? $controller->$method($param) : $controller->$method();

