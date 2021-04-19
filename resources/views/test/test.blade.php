@php
    use App\Models\Dashboard;
    $result = Dashboard::tabThisMonth();
@endphp
{{ dd($result) }}