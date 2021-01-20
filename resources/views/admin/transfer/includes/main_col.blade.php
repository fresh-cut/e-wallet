<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="car-subtitle mb-2 text-muted"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#card" aria-controls="card" aria-selected="true" role="tab">Переводы на карту</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#sop" aria-controls="sop" aria-selected="false" role="tab">Переводы SOP</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="card" role="tabpanel" aria-labelledby="card-tab">
                        @include('admin.transfer.includes.card')
                    </div>
                    <div class="tab-pane" id="sop" role="tabpanel" aria-labelledby="new-tab">
                        @include('admin.transfer.includes.sop')
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
