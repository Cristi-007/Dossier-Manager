<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Evidence</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/adminManagement.css') }}">
        <link rel="stylesheet" href="{{ asset('css/toogle-button.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/general.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main-panel.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dataViewTable.css') }}">
        <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">


        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/dossier_management.js') }}"></script>
        <script src="{{ asset('js/notification.js') }}"></script>
        <script src="{{ asset('js/employee_management.js') }}"></script>
        <script src="{{ asset('js/nomenclatures_manager.js') }}"></script>
        <script src="{{ asset('js/general.js') }}"></script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <!-- Page Content -->
            <main>
                @include('layouts.PostAuthPages.AdminAuthPage')
                @include('layouts.notification.notification')
            </main>
        </div>
    </body>
</html>
