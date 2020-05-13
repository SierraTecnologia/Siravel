<div class="row margin-bottom-10">
    <div class="col-md-6 col-sm-6 col-xs-6">
        Saudações Libertárias
    </div>
</div>

@if(\Illuminate\Support\Facades\Config::get('app.distribuction')!=='prod')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            Atenção - Essa versão não é de produção, maior probabilidade de bugs!
        </div>
    </div>
@endif