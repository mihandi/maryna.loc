<?php
/*
SELECT id,title,
month(FROM_UNIXTIME(created_at,"%Y-%m-%d")) as 'month',
year(FROM_UNIXTIME(created_at,"%Y-%m-%d")) as 'year'
FROM `article`

возвращает номер месяца
*/

function getMonthName($id){
    $month_name[1] = 'Январь';
    $month_name[2] = 'Февраль';
    $month_name[3] = 'Март';
    $month_name[4] = 'Апрель';
    $month_name[5] = 'Май';
    $month_name[6] = 'Июнь';
    $month_name[7] = 'Июль';
    $month_name[8] = 'Август';
    $month_name[9] = 'Сентябрь';
    $month_name[10] = 'Октябрь';
    $month_name[11] = 'Ноябрь';
    $month_name[12] = 'Декабрь';
    return $month_name[$id];

}
?>

<div class="list-widget archive-widget m-b-60">
    <h4 class="lw-title">ARCHIVE</h4>
    <ul class="lw-list-two v-list">
        <?php foreach ($months as $month): ?>
            <li>
                <a href="#">
                    <span class="date"><?= getMonthName($month['month'])?> 2018</span>
                    <span class="totals"><?= $month['count']?></span>
                </a>
            </li>
        <?php endforeach;?>
    </ul>
</div>
