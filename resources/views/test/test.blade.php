@php
    use App\Models\Dashboard;
    $result = Dashboard::tabRecupLastSevenDays();
@endphp
{{ dd($result) }}