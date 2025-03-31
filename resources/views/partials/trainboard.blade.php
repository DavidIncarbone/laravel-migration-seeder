@php use \Carbon\Carbon; @endphp

<table>
 
        <div class="table-container">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Compagnia</th>
                        <th>Codice Treno</th>
                        <th>Stazione di Partenza</th>
                        <th>Stazione di Arrivo</th>
                        <th>Data di Partenza</th>
                        <th>Data di arrivo</th>
                        <th>Orario di Partenza</th>
                        <th>Orario di Arrivo</th>
                        <th>Stato della corsa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trains as $train)
                        <tr>
                            <td class="train-code text-uppercase">{{$train->agency}}</td>
                            <td class="train-code text-uppercase">{{ $train->train_code }}</td>
                            <td>{{ $train->departure_station }}</td>
                            <td>{{ $train->arrival_station }}</td>
                            <td>{{ Carbon::parse($train->departure_date)->format('d/m/Y') }}</td>
                            <td>{{ Carbon::parse($train->arrival_date)->format('d/m/Y') }}</td>
                            <td >{{ Carbon::parse($train->departure_time)->format('H:i') }}</td>
                            <td >{{ Carbon::parse($train->arrival_time)->format('H:i') }}</td>
                            <td>
                                @if($train->on_time)
                                    <span class="on-time">In Orario</span>
                                @elseif($train->on_time === 0 && $train->deleted === 0)
                                    <span class="delayed">In Ritardo</span>
                                @elseif($train->on_time === 0  && $train->deleted === 1)
                                    <span class="deleted">Cancellato</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>