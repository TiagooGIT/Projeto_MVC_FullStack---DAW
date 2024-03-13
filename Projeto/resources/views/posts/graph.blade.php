@extends('layout')
<title>Gráfico - {{ ucfirst($metric) }}</title>

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container mt-5">
        <h2 class="mb-4 fw-bold">Gráfico - {{ ucfirst($metric) }}</h2>

        <form action="{{ route('posts.graph', ['id' => $post->id_post]) }}" method="get" class="mb-3">
            <label for="metric" class="form-label">Escolha a métrica:</label>
            <select name="metric" id="metric" class="form-select">
                <option value="view_more" {{ $metric === 'view_more' ? 'selected' : '' }}>Ver Mais</option>
                <option value="report" {{ $metric === 'report' ? 'selected' : '' }}>Report</option>
                <option value="tradução" {{ $metric === 'traducao' ? 'selected' : '' }}>Traduções</option>
                <option value="tradução_validada" {{ $metric === 'traducao_validada' ? 'selected' : '' }}>Tradução_validada</option>
                <option value="tradução_eliminada" {{ $metric === 'traducao_eliminada' ? 'selected' : '' }}>Tradução_eliminada</option>
            </select>
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary mt-3">Atualizar Gráfico</button>
            </div>
        </form>
        
        <canvas id="interactionChart" width="400" height="200"></canvas>
        <div class="d-flex justify-content-center align-items-center">
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary mt-3">Voltar à Dashboard do {{ auth()->user()->name }}</a>
        </div>
    </div>

    <script src="/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
    <script>
        var ctx = document.getElementById('interactionChart').getContext('2d');
        var interactionChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: '{{ ucfirst($metric) }}',
                    data: {!! json_encode($clicks->values()) !!},
                    backgroundColor: 'rgba(75, 192, 192, 1)',
                    borderColor: 'rgb(0, 0, 0)',
                    borderWidth: 2,
                    fill: false 
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                        max: {!! $clicks->max() + 2 !!},
                    },
                    x: {
                        beginAtZero: false,
                        offset: true,
                    }
                }
            }
        });
    </script>
    
@endsection
