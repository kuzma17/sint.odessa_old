<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 15.06.17
 * Time: 20:10
 */

use App\History;
$histories = History::where('order_id', $id)->get();
?>
<h3>История</h3>

<div class="" >
    @if(count($histories) > 0)
        <table class="table table-striped">
            <tbody>
            <tr>
                <th>Дата:</th><th>Событие:</th><th>Коментарий</th>
            </tr>
            @foreach($histories as $history)
                <tr>
                    <td>{{ $history->created_at }}</td>
                    <td>{{ $history->status_info }}</td>
                    <td>{{ $history->comment or '' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
@endif
</div>