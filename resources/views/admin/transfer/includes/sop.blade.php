<table class="table">
    <thead>
    <tr style="text-align: left">
        <th>id</th>
        <th>ID отправителя</th>
        <th>Тип отправления</th>
        <th>Кому перевод</th>
        <th>Сумма перевода</th>
        <th>Статус</th>
        <th>Дата перевода</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($sop as $item)
        <tr>
            <td align="left" width="5%">{{$item->id}}</td>
            <td align="left" >
                <a href="{{ route('admin.user.edit', $item->who) }}" target="_blank">
                    {{$item->name}}
                </a>
            </td>
            <td align="left">
                <a href="{{ route('admin.transfer.show', $item->id) }}">
                    {{$item->type}}
                </a>
            </td>
            <td align="left">{{$item->whom}}</td>
            <td align="left">{{$item->money}}</td>
            <td align="left">
                @if($item->status==2)
                    <span style="color:blue">В ожидании</span>
                @elseif($item->status==1)
                    <span style="color:green">Успешно</span>
                @else
                    <span style="color:red">Отклонено</span>
                @endif
            </td>
            <td align="left">{{$item->created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@if($sop instanceof Illuminate\Pagination\LengthAwarePaginator && $sop->total() > $sop->count() )
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {{ $sop->links() }}
                </div>
            </div>
        </div>
    </div>
@endif

