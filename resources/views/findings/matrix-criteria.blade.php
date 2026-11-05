
@php
    // Jumlah nilai dihitung dari subelemen paling bawah saja.
    // Subelemen induk tidak dihitung lagi agar tidak terjadi nilai ganda.
    $criterionTotalMax = function ($criterion) use (&$criterionTotalMax) {
        if ($criterion->children->isEmpty()) {
            return (int) ($criterion->max_score ?? 0);
        }

        return $criterion->children->sum(function ($child) use (&$criterionTotalMax) {
            return $criterionTotalMax($child);
        });
    };
@endphp

@foreach ($criteria as $criterion)
    @php
        $hasChildren = $criterion->children->isNotEmpty();
        $criterionLabel = trim(
            ($criterion->code ? $criterion->code . ' - ' : '') . $criterion->name
        );
    @endphp

    <tr
        class="matrix-criterion-row border-t border-slate-100 hover:bg-emerald-50/40"
        data-value="{{ strtolower($criterionLabel) }}"
    >
        <td class="px-4 py-3">
            <div
                class="flex items-start gap-3"
                style="padding-left: {{ min($level * 20, 80) }}px"
            >
                @if ($hasChildren)
                    {{-- Induk hanya menampilkan nama, tanpa checkbox --}}
                    <span class="mt-1 inline-block h-4 w-4 shrink-0"></span>
                @else
                    {{-- Hanya subelemen paling bawah yang bisa dipilih --}}
                    <input
                        type="checkbox"
                        class="matrix-criterion mt-1 h-4 w-4 shrink-0 rounded
                               border-slate-300 text-emerald-600
                               focus:ring-emerald-500"
                        data-element-id="{{ $element->id }}"
                        data-element-label="{{ $element->code }} - {{ $element->name }}"
                        data-value="{{ $criterionLabel }}"
                    >
                @endif

                <span class="text-sm {{ $hasChildren ? 'font-semibold text-slate-800' : 'text-slate-700' }}">
                    @if ($criterion->code)
                        <span class="font-semibold">{{ $criterion->code }}</span>
                        —
                    @endif
                    {{ $criterion->name }}
                </span>
            </div>
        </td>

        <td class="whitespace-nowrap px-4 py-3 text-center text-sm font-medium text-slate-700">
            {{ $criterionTotalMax($criterion) }}
        </td>

        <td class="px-4 py-3 text-center text-sm text-slate-400">
            —
        </td>
    </tr>

    @if ($hasChildren)
        @include('findings.matrix-criteria', [
            'criteria' => $criterion->children,
            'element' => $element,
            'level' => $level + 1,
        ])
    @endif
@endforeach
