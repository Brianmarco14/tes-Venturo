@foreach ($menu as $item)
    @if ($item->kategori == 'minuman')
        <tr style="font-size: 11px">
            <td>{{ $item->menu }}</td>
            @for ($i = 1; $i <= 12; $i++)
                <td class="text-end">{{ number_format($result[$item->menu][$i], 0, ',', '.') }}</td>
            @endfor

            <td class="fw-bold text-end">{{ number_format($jumlahmenu[$item->menu], 0, ',', '.') }}</td>
        </tr>
    @endif
@endforeach