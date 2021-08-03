<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head/>
<body>
    <x-nav-left/>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        
        <x-header/>

        @yield('content')

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <x-footer/>

</body>
</html>
