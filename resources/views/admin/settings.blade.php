
<div class="panel-heading">
    <a href="/admin/settings/1/edit" class="btn btn-primary">
        <i class="fa fa-pencil"></i> Редактировать
    </a>

    <div class="pull-right">
    </div>
</div>
<div style="background-color: #ffffff">
<table  class="table table-striped">
    <colgroup>
        <col width="350px" />
        <col width="" />
    </colgroup>

        <tr>
            <th class="row-header">Название сайта</th><td class="row-link">{{ $settings->title }}</td>
        </tr>
    <tr>
        <th class="row-header">Кпаткое описание сайта</th><td class="row-link">{{ $settings->description }}</td>
    </tr>
    <tr>
        <th class="row-header">Ключевые слова сайта</th><td class="row-link">{{ $settings->keywords }}</td>
    </tr>
    <tr>
        <th class="row-header">Количество выводимых новостей на странице</th><td class="row-link">{{ $settings->count_news }}</td>
    </tr>
    <tr>
        <th class="row-header">Обмен 1С</th><td class="row-link">@if($settings->exchange == 1) вкл. @else откл. @endif </td>
    </tr>

     </table>

</div>