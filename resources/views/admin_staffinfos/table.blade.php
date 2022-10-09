<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css">
<script type="text/javascript">
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#staffinfos-table thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#staffinfos-table thead');

        var table = $('#staffinfos-table').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function() {
                var api = this.api();

                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function(colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title +
                            '" style="width:60px" />');

                        // On every keypress in this input
                        $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                            .off('keyup change')
                            .on('keyup change', function(e) {
                                e.stopPropagation();

                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr =
                                    '({search})'; //$(this).parents('th').find('select').val();

                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != '' ?
                                        regexr.replace('{search}', '(((' + this.value +
                                            ')))') :
                                        '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();

                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },
        });
    });
</script>
<div class="table-responsive">
    <table class="uk-table uk-table-divider uk-table-small" id="staffinfos-table">
        <thead>
            <tr>
                <th>氏名</th>
                <th>チーム</th>
                <th>所属</th>
                <th>役務</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($staffinfos as $staffinfo)
                <tr>
                    <td class="uk-text-small">{{ $staffinfo->user->name }}<br>({{ $staffinfo->furigana }})</td>
                    <td class="uk-text-small">{{ $staffinfo->team }}</td>
                    <td class="uk-text-small">{{ $staffinfo->prefecture }}連盟<br>{{ $staffinfo->district }}地区
                        {{ $staffinfo->dan }}団</td>
                    <td class="uk-text-small">{{ $staffinfo->role }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['admin_staffinfos.destroy', $staffinfo->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('admin_staffinfos.edit', [$staffinfo->id]) }}"
                                class='btn btn-default btn-xs'>
                                編集
                            </a>
                            {!! Form::button('削除', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('スタッフ情報を削除しますか?')",
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#staffinfos-table').DataTable();
    });
</script>
