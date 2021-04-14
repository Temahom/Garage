@php
    use App\Models\Dashboard;
    $interventionVoitureEnGarages = Dashboard::interventionVoitureEnGarages();
@endphp
{{ dd($interventionVoitureEnGarages) }}