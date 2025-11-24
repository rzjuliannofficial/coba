<header class="fixed top-0 left-64 right-0 bg-white shadow-md p-4 z-30 flex justify-between items-center">

    <h1 class="text-xl font-semibold text-gray-800">
        <?= $title ?? "Dashboard"; ?>
    </h1>

    <div class="flex items-center space-x-4">
        <span class="text-gray-700 font-bold">
            <?= $_SESSION['user']['username']; ?>
        </span>

        <a href="/admin/logout" class="text-red-500 hover:text-red-700">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </div>

</header>
